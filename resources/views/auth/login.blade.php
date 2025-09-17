@extends('layouts.guest')

@section('content')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

        <div class="bg-white shadow-lg rounded-2xl w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 overflow-hidden">

            {{-- Left Side - Welcome Text --}}
            <div class="bg-red-500 text-white p-8 flex flex-col justify-center">
                <h1 class="text-3xl font-bold mb-4">Welcome to a NGO Connect</h1>
                <p class="text-lg">Connecting NGOs with Supporters Worldwide. A dedicated social platform where NGOs can
                    share their work, organize events, and connect with volunteers and donors to create meaningful impact.
                </p>
            </div>

            {{-- Right Side - Registration Form --}}
            <div class="p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Login</h2>

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3 md:mb-4">
                        <label for="email" class="block text-sm md:text-base font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="mt-1 p-2 md:p-2 w-full border rounded focus:outline-none focus:ring-2 focus:ring-red-400 bg-white"
                            required />
                    </div>
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Password --}}
                    <div class="mb-3 md:mb-4">
                        <label for="password" class="block text-sm md:text-base font-medium text-gray-700">Password</label>
                        <input type="password" name="password"
                            class="mt-1 p-2 md:p-2 w-full border rounded focus:outline-none focus:ring-2 focus:ring-red-400 bg-white"
                            required />
                    </div>

                    {{-- Submit Button --}}
                    <div>
                        <button type="submit"
                            class="w-full bg-black text-white p-2 md:p-2 rounded hover:bg-gray-800 mt-3 md:mt-4">
                            Log in
                        </button>
                    </div>

                    {{-- Registration Link for New Users --}}
                    <div class="text-center">
                        <p class="mt-3 md:mt-4 text-center">
                            Don't have an accout?
                            <a href="{{ route('register') }}" class="text-red-700 hover:underline">Sign Up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
