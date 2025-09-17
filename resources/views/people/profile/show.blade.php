@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center space-x-4">
            <div class="w-20 h-20 rounded-full overflow-hidden">
                @if (auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile"
                        class="w-full h-full object-cover">
                @else
                    <span class="iconify" data-icon="fluent:person-circle-20-filled" data-width="80" data-height="80"
                        style="color: #6b7280;"></span>
                @endif
            </div>
            <div>
                <h2 class="text-xl font-medium">{{ auth()->user()->name }}</h2>
                <p class="text-gray-600">{{ auth()->user()->email }}</p>
                <a href="{{ route('people.profile.edit') }}"
                    class="mt-2 inline-block px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                    <span class="iconify inline-block mr-2" data-icon="fluent:person-edit-20-filled" data-width="20"
                        data-height="20"></span>
                    Edit Profile
                </a>
            </div>
        </div>
        <div class="mt-6">
            <h3 class="text-lg font-medium text-gray-900">Profile Details</h3>
            <div class="mt-2 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-sm text-gray-500">Full Name</p>
                    <p class="text-gray-900">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="text-gray-900">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
