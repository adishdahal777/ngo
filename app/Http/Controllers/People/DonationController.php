<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationHasPayment;
use App\Models\Ngo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function index()
    {
        $ngos = Ngo::get();

        return view('donation.donate', compact('ngos'));
    }

    // Show payment page or store donation immediately for non-esewa
    public function showPaymentForm(Request $request)
    {
        $request->validate([
            'ngo_id' => 'required|exists:ngos,id',
            'donation_amount' => 'required|integer|min:10',
            'payment_method' => 'required|in:esewa,khalti,cash,cheque',
        ]);

        $total = $request->donation_amount;

        if ($request->payment_method === 'esewa') {
            // Pass data to Blade for eSewa payment
            return view('donation.payment', [
                'total' => $total,
                'ngo_id' => $request->ngo_id,
                'donation_amount' => $request->donation_amount,
                'payment_method' => $request->payment_method,
            ]);
        }

        // Non-esewa payments → directly store donation
        return $this->storeDonation($request);
    }

    // Store donation in DB (kept exactly as you wrote)
    protected function storeDonation(Request $request, $paymentResponse = null)
    {
        $request->validate([
            'ngo_id' => 'required|exists:ngos,id',
            'donation_amount' => 'required|integer|min:10',
            'payment_method' => 'required|in:esewa,khalti,cash,cheque',
        ]);

        DB::transaction(function () use ($request) {
            $donation = Donation::create([
                'user_id' => Auth::id(),
                'ngo_id' => $request->ngo_id,
                'donation_amount' => $request->donation_amount,
                'status' => 'pending',
            ]);

            DonationHasPayment::create([
                'donation_id' => $donation->id,
                'payment_method' => $request->payment_method,
                'payment_response' => json_encode([
                    'amount' => $request->donation_amount,
                    'status' => 'success',
                    'transaction_id' => 'TXN'.rand(0001, 9999),
                ]),
            ]);
        });

        return redirect()->route('common.feed')->with('success', 'Donation created successfully!');
    }

    // eSewa success callback
    public function paymentSuccess(Request $request)
    {
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

    // eSewa failure callback
    public function paymentFail()
    {
        return redirect()->route('common.feed')->with('error', 'Donation failed or cancelled!');
    }
}
