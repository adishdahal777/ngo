    <header class="bg-white shadow-sm border-b border-gray-200 fixed top-0 w-full z-50">
        <div class="grid grid-cols-3  px-4 py-3 items-center">
            <!-- Left Section -->
            <div class="flex items-center space-x-2">
                <div class="w-auto">
                    <img src="{{ url('logo-nobg.png') }}" alt="Logo" class="h-10">
                </div>
            </div>

            <!-- Center Navigation -->
            <div class="flex  min-w-xl max-w-2xl justify-around space-x-2">
                <button class="cursor-pointer">
                    <i class="fas fa-home text-orange-600 text-xl"></i>
                </button>
                <button class="hover:text-gray-400 cursor-pointer">
                    <i class="fas fa-tv text-gray-600 text-xl"></i>
                </button>
                <button class="hover:text-gray-400 cursor-pointer">
                    <i class="fas fa-store text-gray-600 text-xl"></i>
                </button>
                <button class="hover:text-gray-400 cursor-pointer">
                    <i class="fas fa-users text-gray-600 text-xl"></i>
                </button>
            </div>

            <!-- Right Section -->
            <div class="flex items-center space-x-2 justify-end">
                <div class="relative">
                    <button class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 notification-btn">
                        <i class="fas fa-bell text-gray-700"></i>
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </button>

                    <!-- Notification Dropdown -->
                    <div
                        class="notification-dropdown absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900">Notifications</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100">
                                <div class="flex items-start space-x-3">
                                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-plus text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900"><strong>Ronit Paudel</strong> sent you a friend
                                            request.</p>
                                        <p class="text-xs text-blue-600 mt-1">2 hours ago</p>
                                    </div>
                                    <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                                </div>
                            </div>

                            <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100">
                                <div class="flex items-start space-x-3">
                                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900"><strong>Jagat Prasad Dahal</strong> liked your
                                            photo.</p>
                                        <p class="text-xs text-blue-600 mt-1">5 hours ago</p>
                                    </div>
                                    <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                                </div>
                            </div>

                            <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100">
                                <div class="flex items-start space-x-3">
                                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900"><strong>Ambika Dahal</strong> commented on your
                                            post.</p>
                                        <p class="text-xs text-blue-600 mt-1">1 day ago</p>
                                    </div>
                                    <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                                </div>
                            </div>

                            <div class="p-3 hover:bg-gray-50 cursor-pointer">
                                <div class="flex items-start space-x-3">
                                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500"><strong>Bibek Thakur</strong> shared a post in
                                            <strong>CSIT Group</strong>.
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">2 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 border-t border-gray-200">
                            <button class="w-full text-center text-blue-600 hover:bg-gray-50 py-2 rounded-lg">
                                See all notifications
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Added profile dropdown -->
                <div class="relative">
                    <button class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden  profile-btn">
                        @if (auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile"
                                class="w-full h-full object-cover">
                        @else
                            <img src="https://placehold.co/150" alt="Profile" class="w-full h-full object-cover">
                        @endif
                    </button>

                    <!-- Profile Dropdown -->
                    <div
                        class="profile-dropdown absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50">
                        <div class="p-4">
                            <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden">
                                    @if (auth()->user()->profile_photo)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                            alt="Profile" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://placehold.co/150" alt="Profile"
                                            class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Adish Dahal</h3>
                                    <p class="text-sm text-gray-500">See your profile</p>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-200">

                        <div class="p-2">
                            <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-cog text-gray-600"></i>
                                </div>
                                <span class="text-gray-900">Settings & privacy</span>
                                <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                            </div>

                            <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-question-circle text-gray-600"></i>
                                </div>
                                <span class="text-gray-900">Help & support</span>
                                <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                            </div>

                            <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-moon text-gray-600"></i>
                                </div>
                                <span class="text-gray-900">Display & accessibility</span>
                                <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                            </div>

                            <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-gray-600"></i>
                                </div>
                                <span class="text-gray-900">Give feedback</span>
                            </div>

                            <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-sign-out-alt text-gray-600"></i>
                                </div>
                                <span class="text-gray-900">Log out</span>
                            </div>
                        </div>

                        <div class="p-3 border-t border-gray-200">
                            <p class="text-xs text-gray-500">Privacy · Terms · Advertising · Ad choices · Cookies ·
                                Meta © 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
