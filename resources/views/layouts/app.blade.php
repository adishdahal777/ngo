<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Clone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js"
        integrity="sha512-lYMiwcB608+RcqJmP93CMe7b4i9G9QK1RbixsNu4PzMRJMsqr/bUrkXUuFzCNsRUo3IXNUr5hz98lINURv5CNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    @include('layouts.partials.header')

    <div class="flex pt-16">
        <!-- Left Sidebar -->
        @if (auth()->user()->isPeople())
            @include('layouts.people.left-sidebar')
        @endif
        @if (auth()->user()->isNgo())
            @include('layouts.ngo.left-sidebar')
        @endif
        <!-- Main Content -->
        <div class="flex-1 ml-80 mr-80 px-4 py-6">
            <div class="max-w-3xl mx-auto">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </div>

        <!-- Right Sidebar -->
        {{-- @include('layouts.people.right-sidebar') --}}

    </div>



    <script>
        $(document).ready(function() {
            $('.notification-btn').on('click', function() {
                $('.notification-dropdown').toggleClass('hidden');
                $('.profile-dropdown').addClass('hidden');
            });

            $('.profile-btn').on('click', function() {
                $('.profile-dropdown').toggleClass('hidden');
                $('.notification-dropdown').addClass('hidden');
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.notification-btn, .notification-dropdown').length) {
                    $('.notification-dropdown').addClass('hidden');
                }
                if (!$(e.target).closest('.profile-btn, .profile-dropdown').length) {
                    $('.profile-dropdown').addClass('hidden');
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
