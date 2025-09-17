@extends('layouts.app')


@section('content')


    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="bg-white p-6 rounded-lg shadow">
        <form id="profileForm" action="{{ route('people.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    required>
            </div>
            <div class="mb-4">
                <label for="profile_photo" class="block text-sm font-medium text-gray-700">Profile Photo</label>
                <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                @if (auth()->user()->profile_photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Current Profile Photo"
                            class="w-20 h-20 rounded-full object-cover">
                    </div>
                @else
                    <div class="mt-2">
                        <span class="iconify" data-icon="fluent:person-circle-20-filled" data-width="80" data-height="80"
                            style="color: #6b7280;"></span>
                    </div>
                @endif
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                    <span class="iconify inline-block mr-2" data-icon="fluent:save-20-filled" data-width="20"
                        data-height="20"></span>
                    Save Changes
                </button>
                <a href="{{ route('people.profile') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    <span class="iconify inline-block mr-2" data-icon="fluent:dismiss-20-filled" data-width="20"
                        data-height="20"></span>
                    Cancel
                </a>
            </div>
        </form>
    </div>


@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#profileForm').on('submit', function(e) {
                let name = $('#name').val().trim();
                if (!name) {
                    e.preventDefault();
                    alert('Please enter your full name.');
                }
            });
            $('#profile_photo').on('change', function() {
                let file = this.files[0];
                if (file && !['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    alert('Please select a valid image file (JPG, PNG).');
                    this.value = '';
                }
            });
        });
    </script>
@endpush
