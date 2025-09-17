@extends('layouts.app')

@section('content')

    <div class="ml-80 p-6 w-full">
        <h1 class="text-2xl font-bold mb-4">Edit NGO Profile</h1>
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
        <div class="bg-white p-6 rounded-lg shadow">
            <form id="ngoProfileForm" action="{{ route('ngo.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">NGO Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $ngo->name ?? '') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" id="location"
                            value="{{ old('location', $ngo->location ?? '') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category" id="category"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                            <option value="">Select Category</option>
                            <option value="education"
                                {{ old('category', $ngo->category ?? '') == 'education' ? 'selected' : '' }}>
                                Education</option>
                            <option value="health"
                                {{ old('category', $ngo->category ?? '') == 'health' ? 'selected' : '' }}>Health
                            </option>
                            <option value="environment"
                                {{ old('category', $ngo->category ?? '') == 'environment' ? 'selected' : '' }}>
                                Environment</option>
                            <option value="poverty"
                                {{ old('category', $ngo->category ?? '') == 'poverty' ? 'selected' : '' }}>Poverty
                                Alleviation</option>
                        </select>
                    </div>
                    <div>
                        <label for="sub_categories" class="block text-sm font-medium text-gray-700">Sub
                            Categories</label>
                        <input type="text" name="sub_categories" id="sub_categories"
                            value="{{ old('sub_categories', $ngo->sub_categories ?? '') }}"
                            placeholder="e.g., scholarship, medical"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="mission" class="block text-sm font-medium text-gray-700">Mission</label>
                        <textarea name="mission" id="mission" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">{{ old('mission', $ngo->mission ?? '') }}</textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="6"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">{{ old('description', $ngo->description ?? '') }}</textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                        <input type="file" name="logo" id="logo" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        @if ($ngo && $ngo->logo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $ngo->logo) }}" alt="Current Logo"
                                    class="w-20 h-20 rounded-lg object-cover">
                            </div>
                        @else
                            <div class="mt-2">
                                <span class="iconify" data-icon="fluent:people-community-20-filled" data-width="80"
                                    data-height="80" style="color: #6b7280;"></span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-6 flex items-center space-x-4">
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                        <span class="iconify inline-block mr-2" data-icon="fluent:save-20-filled" data-width="20"
                            data-height="20"></span>
                        Save Changes
                    </button>
                    <a href="{{ route('ngo.profile') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        <span class="iconify inline-block mr-2" data-icon="fluent:dismiss-20-filled" data-width="20"
                            data-height="20"></span>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#ngoProfileForm').on('submit', function(e) {
                let name = $('#name').val().trim();
                if (!name) {
                    e.preventDefault();
                    alert('Please enter the NGO name.');
                }
            });
            $('#logo').on('change', function() {
                let file = this.files[0];
                if (file && !['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    alert('Please select a valid image file (JPG, PNG).');
                    this.value = '';
                }
            });
        });
    </script>
@endpush
