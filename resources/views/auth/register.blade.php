@extends('layouts.guest')

@section('content')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

        <div class="bg-white shadow-lg rounded-2xl w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 overflow-hidden">

            <!-- Left Sidebar -->
            <div class="bg-red-500 text-white p-8 flex flex-col justify-center">
                <h1 class="text-3xl font-bold mb-4">Welcome to NGO Connect</h1>
                <p class="text-lg">Connecting NGOs with Supporters Worldwide. A dedicated social platform
                    where NGOs can share their work, organize events, and connect with volunteers and donors to create
                    meaningful impact.</p>
            </div>

            <!-- Right Form Section -->
            <div class="p-8">
                <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-center text-gray-900">Register</h2>

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-3 md:p-4 mb-3 md:mb-4 rounded">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 md:p-4 mb-3 md:mb-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Common Fields -->
                    <div class="mb-3 md:mb-4">
                        <label for="name" class="block text-sm md:text-base font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="mt-1 p-2 md:p-2 w-full border rounded focus:outline-none focus:ring-2 focus:ring-red-400 bg-white"
                            required>
                    </div>
                    <div class="mb-3 md:mb-4">
                        <label for="email" class="block text-sm md:text-base font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="mt-1 p-2 md:p-2 w-full border rounded focus:outline-none focus:ring-2 focus:ring-red-400 bg-white"
                            required>
                    </div>
                    <div class="mb-3 md:mb-4">
                        <label for="password" class="block text-sm md:text-base font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 p-2 md:p-2 w-full border rounded focus:outline-none focus:ring-2 focus:ring-red-400 bg-white"
                            required>
                    </div>
                    <div class="mb-3 md:mb-4">
                        <label for="password_confirmation"
                            class="block text-sm md:text-base font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 p-2 md:p-2 w-full border rounded focus:outline-none focus:ring-2 focus:ring-red-400 bg-white"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-black text-white p-2 md:p-2 rounded hover:bg-gray-800 mt-3 md:mt-4">Register</button>
                </form>
                <p class="mt-3 md:mt-4 text-center">
                    Already registered? <a href="{{ route('login') }}" class="text-red-700 hover:underline">Sign In</a>
                </p>
            </div>
        </div>
    </div>
    </div>
@endsection
