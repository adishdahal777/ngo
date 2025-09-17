<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationHasPayment;
use App\Models\User;
use App\Notifications\DonationReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $ngos = User::where('role_id', 1)->where('verified', true)->get();
        $donations = Donation::where('user_id', Auth::id())->with(['ngo', 'payments'])->paginate(10);
        return view('people.donations.index', compact('ngos', 'donations'));
    }

    public function showPaymentForm(Request $request)
    {
        $request->validate([
            'ngo_id' => 'required|exists:users,id',
            'donation_amount' => 'required|numeric|min:10',
            'payment_method' => 'required|in:esewa,khalti,cash,cheque',
        ]);

        $ngo = User::where('role_id', 1)->findOrFail($request->ngo_id);
        if (!$ngo->verified) {
            return redirect()->back()->with('error', 'This NGO is not verified to accept donations.');
        }

        if ($request->payment_method === 'esewa') {
            return view('people.donations.payment', [
                'total' => $request->donation_amount,
                'ngo_id' => $request->ngo_id,
                'donation_amount' => $request->donation_amount,
                'payment_method' => $request->payment_method,
            ]);
        }

        return $this->storeDonation($request);
    }

    protected function storeDonation(Request $request, $paymentResponse = null)
    {
        $request->validate([
            'ngo_id' => 'required|exists:users,id',
            'donation_amount' => 'required|numeric|min:10',
            'payment_method' => 'required|in:esewa,khalti,cash,cheque',
        ]);

        $ngo = User::where('role_id', 1)->findOrFail($request->ngo_id);
        if (!$ngo->verified) {
            return redirect()->back()->with('error', 'This NGO is not verified to accept donations.');
        }

        $status = in_array($request->payment_method, ['cash', 'cheque']) ? 'pending' : 'completed';
        $paymentStatus = in_array($request->payment_method, ['cash', 'cheque']) ? 'pending' : 'success';

        DB::transaction(function () use ($request, $status, $paymentStatus, $paymentResponse) {
            $donation = Donation::create([
                'user_id' => Auth::id(),
                'ngo_id' => $request->ngo_id,
                'donation_amount' => $request->donation_amount,
                'status' => $status,
            ]);

            DonationHasPayment::create([
                'donation_id' => $donation->id,
                'payment_method' => $request->payment_method,
                'payment_response' => json_encode($paymentResponse ?? [
                    'amount' => $request->donation_amount,
                    'status' => $paymentStatus,
                    'transaction_id' => 'TXN' . rand(1000, 9999),
                ]),
                'status' => $paymentStatus,
            ]);

            // Notify the donating user for completed (eSewa/Khalti) donations
            if ($status === 'completed') {
                $user = User::find($donation->user_id);
                $user->notify(new DonationReceived($donation));
            }
        });

        return redirect()->route('common.feed')->with('success', 'Donation created successfully!');
    }

    public function paymentSuccess(Request $request)
    {
        $request->validate([
            'ngo_id' => 'required|exists:users,id',
            'donation_amount' => 'required|numeric|min:10',
            'amount' => 'required|numeric|min:10',
            'status' => 'required|in:success',
            'transaction_id' => 'required|string',
        ]);

        $paymentResponse = [
            'amount' => $request->query('amount'),
            'status' => $request->query('status'),
            'transaction_id' => $request->query('transaction_id'),
        ];

        $fakeRequest = new Request([
            'ngo_id' => $request->query('ngo_id'),
            'donation_amount' => $request->query('donation_amount'),
            'payment_method' => 'esewa',
        ]);

        return $this->storeDonation($fakeRequest, $paymentResponse);
    }

    public function paymentFail()
    {
        return redirect()->route('common.feed')->with('error', 'Donation failed or cancelled!');
    }
}
