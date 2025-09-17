<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function switchToNgo(Request $request, $ngoId)
    {
        $user = Auth::user();

        if (!$user->isPeople()) {
            return redirect()->route('people.feed')->with('error', 'Only people can switch to NGO accounts.');
        }

        $ngo = $user->ownedNgos()->findOrFail($ngoId);

        $request->session()->put('view_as', 1); // Set view_as to NGO role
        $request->session()->put('view_as_ngo_id', $ngo->id); // Store NGO user ID

        return redirect()->route('ngo.profile')->with('success', 'Switched to NGO account.');
    }

    public function switchBack(Request $request)
    {
        $request->session()->forget(['view_as', 'view_as_ngo_id']);
        return redirect()->route('people.profile')->with('success', 'Switched back to your personal account.');
    }
}
