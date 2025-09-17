<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function events()
    {
        $events = Event::where('user_id', Auth::user()->id)->paginate(10);
        return view('ngo.events.index', compact('events'));
    }

    public function createEvent()
    {
        return view('ngo.events.create');
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|in:0,1',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'cover_image_path_name' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'capacity' => 'required|string|max:255',
            'is_volunteers_required' => 'required|boolean',
        ]);

        $event = new Event($request->only([
            'title',
            'description',
            'location',
            'type',
            'start_date',
            'end_date',
            'capacity',
            'is_volunteers_required',
        ]));
        $event->user_id = Auth::user()->id;

        if ($request->hasFile('cover_image_path_name')) {
            $path = $request->file('cover_image_path_name')->store('event_images', 'public');
            $event->cover_image_path_name = $path;
        }

        $event->save();

        return redirect()->route('ngo.events')->with('success', 'Event created successfully.');
    }
}
