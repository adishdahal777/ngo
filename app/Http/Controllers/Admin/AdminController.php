<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\NgoRegistrationApproved;
use App\Notifications\NgoRegistrationRejected;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'role:admin']);
    }

    public function ngos()
    {
        $ngos = User::where('role_id', 1)->with('ngo')->paginate(10);
        return view('admin.ngos.index', compact('ngos'));
    }

    public function show($id)
    {
        $ngo = User::where('role_id', 1)->with('ngo')->findOrFail($id);
        return view('admin.ngos.show', compact('ngo'));
    }

    public function verifyNgo(Request $request, $id)
    {
        $ngo = User::where('role_id', 1)->findOrFail($id);
        $ngo->update(['verified' => true]);

        // Notify the NGO
        $ngo->notify(new NgoRegistrationApproved($ngo->name, true));

        // Notify the owner if exists
        if ($ngo->owner_id) {
            $owner = User::find($ngo->owner_id);
            if ($owner) {
                $owner->notify(new NgoRegistrationApproved($ngo->name, false));
            }
        }

        return redirect()->route('admin.ngos')->with('success', 'NGO verified successfully.');
    }

    public function rejectNgo(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $ngo = User::where('role_id', 1)->findOrFail($id);
        $ngo->notify(new NgoRegistrationRejected($request->rejection_reason));
        $ngo->delete(); // Cascades to delete ngos entry
        return redirect()->route('admin.ngos')->with('success', 'NGO registration rejected and deleted.');
    }
}
