<div class="w-80 h-screen overflow-y-auto scrollbar-hide bg-white fixed left-0 p-4">
    <!-- NGO Profile -->
    <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 cursor-pointer mb-4">
        <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden">
            @if (auth()->user()->ngo && auth()->user()->ngo->logo)
                <img src="{{ asset('storage/' . auth()->user()->ngo->logo) }}" alt="NGO Logo"
                    class="w-full h-full object-cover">
            @else
                <span class="iconify" data-icon="fluent:people-community-20-filled" data-width="36" data-height="36"
                    style="color: #6b7280;"></span>
            @endif
        </div>
        <span
            class="font-medium text-gray-900">{{ auth()->user()->isNgo() ? auth()->user()->name : auth()->user()->ngo->name }}</span>
    </div>

    <!-- Navigation Items -->
    <div class="space-y-2">
        <a href="{{ route('ngo.profile') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:person-edit-32" data-width="34" data-height="34"></span>

            <span class="text-gray-900">My Profile</span>
        </a>

        <a href="{{ route('ngo.events') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:calendar-32" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Events</span>
        </a>

        <a href="{{ route('common.feed') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:news-28" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Newsfeed</span>
        </a>

        <a href="{{ route('ngo.volunteers') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:heart-48" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Volunteers</span>
        </a>

        <a href="{{ route('ngo.donations') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:trophy-16" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Donations</span>
        </a>

        <a href="{{ route('ngo.notifications') }}"
            class="flex items-center space-x-3 py-3 px-3 rounded-lg hover:bg-gray-100 cursor-pointer">
            <span class="iconify" data-icon="fluent-color:alert-48" data-width="34" data-height="34"></span>
            <span class="text-gray-900">Notifications</span>
            @if (auth()->user()->unreadNotifications->count() > 0)
                <span
                    class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ auth()->user()->unreadNotifications->count() }}</span>
            @endif
        </a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
    $(document).ready(function() {
        $('.cursor-pointer').on('click', function() {
            if ($(this).find('a').length) {
                window.location.href = $(this).find('a').attr('href');
            }
        });
    });
</script>
