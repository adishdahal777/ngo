@extends('layouts.app')

@section('content')
    <!DOCTYPE html>

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
        <form id="eventForm" action="{{ route('ngo.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                        required>
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="6"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" id="type"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                        required>
                        <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Online</option>
                        <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Offline</option>
                    </select>
                </div>
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                    <input type="text" name="capacity" id="capacity" value="{{ old('capacity') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="is_volunteers_required" class="block text-sm font-medium text-gray-700">Volunteers
                        Required</label>
                    <select name="is_volunteers_required" id="is_volunteers_required"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                        required>
                        <option value="1" {{ old('is_volunteers_required') == '1' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="0" {{ old('is_volunteers_required') == '0' ? 'selected' : '' }}>No
                        </option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="cover_image_path_name" class="block text-sm font-medium text-gray-700">Cover
                        Image</label>
                    <input type="file" name="cover_image_path_name" id="cover_image_path_name" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                </div>
            </div>
            <div class="mt-6 flex items-center space-x-4">
                <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                    <span class="iconify inline-block mr-2" data-icon="fluent:save-20-filled" data-width="20"
                        data-height="20"></span>
                    Create Event
                </button>
                <a href="{{ route('ngo.events') }}"
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
            $('#eventForm').on('submit', function(e) {
                let title = $('#title').val().trim();
                let location = $('#location').val().trim();
                let startDate = $('#start_date').val();
                let endDate = $('#end_date').val();
                let capacity = $('#capacity').val().trim();

                if (!title || !location || !startDate || !endDate || !capacity) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                    return false;
                }

                let start = new Date(startDate);
                let end = new Date(endDate);
                let now = new Date();
                if (start <= now) {
                    e.preventDefault();
                    alert('Start date must be in the future.');
                    return false;
                }
                if (end <= start) {
                    e.preventDefault();
                    alert('End date must be after start date.');
                    return false;
                }
            });

            $('#cover_image_path_name').on('change', function() {
                let file = this.files[0];
                if (file && !['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    alert('Please select a valid image file (JPG, PNG).');
                    this.value = '';
                }
            });
        });
    </script>
@endpush
