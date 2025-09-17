<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Models\Ngo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NgoController extends Controller
{
    public function show()
    {
        $ngo = Auth::user()->ngo;
        if (!$ngo) {
            return redirect()->route('ngo.profile.edit')->with('error', 'Please complete your NGO profile.');
        }
        return view('ngo.profile.show', compact('ngo'));
    }

    public function edit()
    {
        $ngo = Auth::user()->ngo;
        return view('ngo.profile.edit', compact('ngo'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $ngo = $user->ngo ?? new Ngo(['user_id' => $user->id]);

        $request->validate([
            'name' => 'required|string|max:255',
            'mission' => 'nullable|string|max:1000',
            'description' => 'nullable|string|max:2000',
            'location' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'sub_categories' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $ngo->fill($request->only(['name', 'mission', 'description', 'location', 'category', 'sub_categories']));

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('ngo_logos', 'public');
            $ngo->logo = $path;
        }

        $ngo->save();

        // Associate the NGO with the user if not already linked
        if (!$user->ngo) {
            $user->ngo()->save($ngo);
        }

        return redirect()->route('ngo.profile')->with('success', 'NGO profile updated successfully.');
    }

    public function events()
    {
        // Placeholder for events listing
        return view('ngo.events.index');
    }

    public function volunteers()
    {
        // Placeholder for volunteers listing
        return view('ngo.volunteers.index');
    }

    public function donations()
    {
        // Placeholder for donations listing
        return view('ngo.donations.index');
    }

    public function notifications()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('ngo.notifications.index', compact('notifications'));
    }
}
