@extends('layouts.app')
@section('content')

    @if ($events->isEmpty())
        <div class="text-center py-12">
            <span class="iconify text-6xl text-gray-300 mx-auto block mb-4" data-icon="fluent:people-team-20-filled"
                data-width="48" data-height="48"></span>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Volunteers Found</h3>
            <p class="text-gray-600">Create events to attract volunteers.</p>
        </div>
    @else
        @foreach ($events as $event)
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-medium text-gray-900 mb-4">{{ $event->title }}</h2>
                @if ($event->volunteers->isEmpty())
                    <p class="text-gray-600">No volunteers registered for this event.</p>
                @else
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($event->volunteers as $volunteer)
                            <div class="flex items-center space-x-3 p-3 border rounded-lg">
                                <div
                                    class="w-10 h-10 rounded-full overflow-hidden bg-gray-300 flex items-center justify-center">
                                    @if ($volunteer->profile_photo)
                                        <img src="{{ asset('storage/' . $volunteer->profile_photo) }}"
                                            alt="{{ $volunteer->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="iconify" data-icon="fluent:person-circle-20-filled" data-width="36"
                                            data-height="36" style="color: #6b7280;"></span>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-900">{{ $volunteer->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $volunteer->email }}</p>
                                </div>
                                <div>
                                    @if ($volunteer->pivot->status === 'accepted')
                                        <span class="text-green-600 text-sm">Verified</span>
                                    @else
                                        <form action="{{ route('ngo.volunteers.verify', [$event->id, $volunteer->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-3 py-1 bg-orange-500 text-white rounded-lg hover:bg-orange-600 text-sm">
                                                <span class="iconify inline-block mr-2"
                                                    data-icon="fluent:checkmark-circle-20-filled" data-width="16"
                                                    data-height="16"></span>
                                                Verify
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    @endif
@endsection
