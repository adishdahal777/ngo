<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventHasVolunteer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    //
    public function index()
    {
        $events = Event::get()->where('is_volunteers_required', true);

        return view('people.volunteer.show', compact('events'));
    }

    public function apply(Request $request)
    {
        $event = Event::FindorFail($request->event_id)->where('is_volunteers_required', true);
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $event = Event::findOrFail($request->event_id);
        $user = Auth::user();

        // Ensure user is authenticated and not the event organizer
        if (! $user || $user->id === $event->user_id) {
            return response()->json(['message' => 'Unauthorized or cannot register for own event'], 401);
        }

        // Check capacity and volunteer requirement
        if (! $event->is_volunteers_required) {
            return response()->json(['message' => 'Volunteers are not required for this event'], 400);
        }

        // TODO
        // Error regarding volunteerRegistration() function so not implemented till now Someone Check

        // $registeredCount = $event->volunteer()->where('status', 'accepted')->count();
        // if ($registeredCount >= $event->capacity) {
        //     return response()->json(['message' => 'Event capacity reached'], 400);
        // }

        // Check if user is already registered
        $existingRegistration = EventHasVolunteer::where('user_id', $user->id)
            ->where('event_id', $request->event_id)
            ->first();

        if ($existingRegistration) {
            return response()->json(['message' => 'Already registered for this event'], 400);
        }

        // Register volunteer with pending status
        EventHasVolunteer::create([
            'event_id' => $request->event_id,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registration submitted successfully',
            'status' => 'pending',
        ], 201);
    }
}
