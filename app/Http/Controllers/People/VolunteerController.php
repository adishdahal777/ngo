<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventHasVolunteer;
use App\Models\User;
use App\Notifications\VolunteerRegistered;
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
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $event = Event::findOrFail($request->event_id);
        $user = Auth::user();

        // Ensure user is authenticated and not the event organizer
        if (!$user || $user->id === $event->user_id) {
            return response()->json(['message' => 'Unauthorized or cannot register for own event'], 401);
        }

        // Check if volunteers are required
        if (!$event->is_volunteers_required) {
            return response()->json(['message' => 'Volunteers are not required for this event'], 400);
        }

        // Check event capacity
        $registeredCount = $event->volunteers()->where('status', 'accepted')->count();
        if ($registeredCount >= $event->capacity) {
            return response()->json(['message' => 'Event capacity reached'], 400);
        }

        // Check if user is already registered
        if ($event->volunteers()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'Already registered for this event'], 400);
        }

        // Register volunteer with pending status
        $event->volunteers()->attach($user->id, ['status' => 'pending']);

        // Notify the NGO owner
        $ngoUser = $event->user;
        $ngoUser->notify(new VolunteerRegistered($event, $user));

        return response()->json([
            'success' => true,
            'message' => 'Registration submitted successfully',
            'status' => 'pending',
        ], 201);
    }
}
