<header class="bg-white shadow-sm border-b border-gray-200 fixed top-0 w-full z-50">
    <div class="grid grid-cols-3 px-4 py-3 items-center">
        <!-- Left Section -->
        <div class="flex items-center space-x-2">
            <div class="w-auto">
                <img src="{{ url('logo-nobg.png') }}" alt="Logo" class="h-10">
            </div>
        </div>

        <!-- Center Navigation -->
        <div class="flex min-w-xl max-w-2xl justify-around space-x-2">
            <a href="{{ route('admin.dashboard') }}" class="cursor-pointer">
                <span class="iconify" data-icon="fluent-color:home-48" data-width="34" data-height="34"></span>
            </a>
            <a href="{{ route('admin.ngos') }}" class="hover:text-gray-400 cursor-pointer">
                <span class="iconify" data-icon="fluent-color:person-add-32" data-width="34" data-height="34"></span>
            </a>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-2 justify-end">
            <div class="relative">
                <button class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 notification-btn">
                    <span class="iconify text-gray-700" data-icon="mdi:bell"></span>
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif
                </button>

                <!-- Notification Dropdown -->
                <div
                    class="notification-dropdown absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900">Notifications</h3>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        @forelse (auth()->user()->unreadNotifications as $notification)
                            <div class="p-3 hover:bg-gray-50 cursor-pointer bg-blue-50">
                                <div class="flex items-start space-x-3">
                                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                        <span class="iconify text-gray-500" data-icon="mdi:bell"></span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500">
                                            {{ $notification->data['message'] ?? 'Notification' }}</p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="p-3 text-gray-600 text-sm">No new notifications.</p>
                        @endforelse
                    </div>
                    <div class="p-3 border-t border-gray-200">
                        <a href="{{ route(auth()->user()->isNgo() ? 'ngo.notifications' : 'people.notifications') }}"
                            class="w-full text-center text-blue-600 hover:bg-gray-50 py-2 rounded-lg block">
                            See all notifications
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden profile-btn">
                    @if (auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    @else
                        <span class="iconify text-gray-500 text-3xl" data-icon="mdi:account-circle"></span>
                    @endif
                </button>

                <!-- Profile Dropdown -->
                <div
                    class="profile-dropdown absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50">
                    <div class="p-4">
                        <a href="{{ route(auth()->user()->isNgo() ? 'ngo.profile' : 'people.profile') }}"
                            class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                            <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden">
                                @if (auth()->user()->profile_photo)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="iconify text-gray-500 text-3xl" data-icon="mdi:account-circle"></span>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                                <p class="text-sm text-gray-500">See your profile</p>
                            </div>
                        </a>
                    </div>

                    <hr class="border-gray-200">

                    <div class="p-2">
                        <form action="{{ route('logout') }}" method="POST"
                            class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                            @csrf
                            <button type="submit" class="flex items-center space-x-3 w-full text-left">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="iconify text-gray-600" data-icon="mdi:logout"></span>
                                </div>
                                <span class="text-gray-900">Log out</span>
                            </button>
                        </form>
                    </div>

                    <div class="p-3 border-t border-gray-200">
                        <p class="text-xs text-gray-500">Privacy · Terms · Advertising · Ad Choices · Cookies · © 2025
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
