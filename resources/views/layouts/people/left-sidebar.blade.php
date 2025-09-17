<div class="w-80 h-screen overflow-y-auto scrollbar-hide bg-white fixed left-0 p-4">
    <!-- User Profile -->
    <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 cursor-pointer mb-4">
        <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden">
            @if (auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile"
                    class="w-full h-full object-cover">
            @else
                <img src="https://placehold.co/150" alt="Profile" class="w-full h-full object-cover">
            @endif
        </div>
        <span class="font-medium text-gray-900">{{ auth()->user()->name }}</span>
    </div>

    <!-- Navigation Items -->
    <div class="space-y-2">
        <a href="{{ route('people.profile') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:person-edit-32" data-width="34" data-height="34"></span>
            <span class="text-gray-900">My Profile</span>
        </a>

        <a href="{{ route('people.ngo.register.form') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:person-add-32" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Create NGO</span>
        </a>

        <a href="{{ route('people.ngo.search') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:search-sparkle-32" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Search NGOs</span>
        </a>

        <a href="{{ route('common.feed') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:news-28" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Newsfeed</span>
        </a>

        <a href="{{ route('people.volunteer.opportunities') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:heart-48" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Volunteer Opportunities</span>
        </a>

        <a href="{{ route('people.donations') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:trophy-16" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Donations</span>
        </a>

        <a href="{{ route('people.notifications') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:alert-48" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Notifications</span>
            @if (auth()->user()->unreadNotifications->count() > 0)
                <span
                    class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ auth()->user()->unreadNotifications->count() }}</span>
            @endif
        </a>
    </div>

    <!-- Your Shortcuts (Favorite NGOs) -->
    @if (auth()->user()->favoriteNgos()->count() > 0)

        <div class="mt-2 border-t-2 pt-4 border-gray-200">
            <h3 class="text-gray-500 font-medium mb-3">Favorite NGOs</h3>
            <div class="space-y-1">
                @forelse (auth()->user()->favoriteNgos()->get() as $ngo)
                    <a href="{{ route('people.ngo.profile', $ngo->id) }}"
                        class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
                        <div class=" rounded-lg overflow-hidden">
                            @if ($ngo->logo)
                                <img src="{{ asset('storage/' . $ngo->logo) }}" alt="{{ $ngo->name }}"
                                    class="w-10 h-10 object-cover">
                            @else
                                <span class="iconify w-full h-full flex items-center justify-center"
                                    data-icon="fluent-color:building-48" data-width="34" data-height="34"></span>
                            @endif
                        </div>
                        <span class="text-gray-900">{{ $ngo->user->name }}</span>
                    </a>
                @empty
                    <p class="text-gray-600 text-sm">No favorite NGOs yet.</p>
                @endforelse

            </div>
        </div>
    @endif
</div>
