@extends('layouts.app')
@section('content')

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Events</h1>
        <a href="{{ route('ngo.events.create') }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
            <span class="iconify inline-block mr-2" data-icon="fluent:add-circle-20-filled" data-width="20"
                data-height="20"></span>
            Create Event
        </a>
    </div>

    @if ($events->isEmpty())
        <div class="text-center py-12">
            <span class="iconify text-6xl text-gray-300 mx-auto block mb-4" data-icon="fluent:calendar-20-filled"
                data-width="48" data-height="48"></span>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Events Found</h3>
            <p class="text-gray-600">Create an event to get started.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="p-4">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-12 h-12 rounded-lg overflow-hidden bg-orange-500 flex items-center justify-center">
                                @if ($event->cover_image_path_name)
                                    <img src="{{ asset('storage/' . $event->cover_image_path_name) }}"
                                        alt="{{ $event->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="iconify text-white" data-icon="fluent:calendar-20-filled" data-width="20"
                                        data-height="20"></span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-medium text-gray-900 truncate">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $event->start_date->format('F j, Y, g:i A') }}</p>
                                <p class="text-sm text-orange-500">{{ $event->location }}</p>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $event->description }}</p>
                        <div class="mt-2 flex justify-between items-center">
                            <span class="text-sm text-gray-500">Volunteers:
                                {{ $event->volunteers()->count() }}/{{ $event->capacity }}</span>
                            <span class="text-sm text-gray-500">{{ $event->type == 0 ? 'Online' : 'Offline' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $events->links() }}
    @endif

@endsection
