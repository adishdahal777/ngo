<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function volunteers()
    {
        $events = Event::where('user_id', Auth::user()->id)->with('volunteers')->get();
        return view('ngo.volunteers.index', compact('events'));
    }

    public function verifyVolunteer(Request $request, $eventId, $userId)
    {
        $event = Event::findOrFail($eventId);
        if ($event->user_id !== Auth::user()->id) {
            return redirect()->route('ngo.volunteers')->with('error', 'Unauthorized action.');
        }

        $event->volunteers()->updateExistingPivot($userId, ['is_verified' => true]);

        $volunteer = User::findOrFail($userId);
        $volunteer->notify(new \App\Notifications\VolunteerVerified($event));

        return redirect()->route('ngo.volunteers')->with('success', 'Volunteer verified successfully.');
    }
}
