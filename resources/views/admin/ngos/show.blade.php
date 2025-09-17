@extends('layouts.app')
@section('content')

    <div class="bg-white border border-gray-200 rounded-lg p-8">
        <div class="flex items-center mb-6">
            @if ($ngo->ngo && $ngo->ngo->photos && count($ngo->ngo->photos) > 0)
                <img src="{{ Storage::url($ngo->ngo->photos[0]) }}" alt="{{ $ngo->name }}"
                    class="w-16 h-16 object-cover rounded-full mr-4">
            @else
                <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-building text-gray-500"></i>
                </div>
            @endif
            <div>
                <p class="text-sm text-gray-500">Email: {{ $ngo->email }}</p>
                <p class="text-sm text-gray-500">Category: {{ $ngo->ngo ? ucfirst($ngo->ngo->category) : 'N/A' }}</p>
                <p class="text-sm text-gray-500">Status: {{ $ngo->verified ? 'Verified' : 'Pending' }}</p>
            </div>
        </div>
        <h2 class="text-lg font-medium mb-2">Mission</h2>
        <p class="text-sm text-gray-600 mb-4">{{ $ngo->ngo ? $ngo->ngo->mission : 'N/A' }}</p>
        <h2 class="text-lg font-medium mb-2">Description</h2>
        <p class="text-sm text-gray-600 mb-4">{{ $ngo->ngo ? $ngo->ngo->description : 'N/A' }}</p>
        @if ($ngo->ngo && $ngo->ngo->location)
            <h2 class="text-lg font-medium mb-2">Location</h2>
            <p class="text-sm text-gray-600 mb-4">{{ $ngo->ngo->location }}</p>
        @endif
        @if ($ngo->ngo && $ngo->ngo->sub_categories)
            <h2 class="text-lg font-medium mb-2">Sub Categories</h2>
            <p class="text-sm text-gray-600 mb-4">{{ $ngo->ngo->sub_categories }}</p>
        @endif
        @if ($ngo->ngo && $ngo->ngo->photos && count($ngo->ngo->photos) > 0)
            <h2 class="text-lg font-medium mb-2">Photos</h2>
            <div class="grid grid-cols-3 gap-4 mb-4">
                @foreach ($ngo->ngo->photos as $photo)
                    <img src="{{ Storage::url($photo) }}" alt="NGO Photo" class="w-full h-32 object-cover rounded-md">
                @endforeach
            </div>
        @endif
        @if ($ngo->ngo && $ngo->ngo->documents && count($ngo->ngo->documents) > 0)
            <h2 class="text-lg font-medium mb-2">Verification Documents</h2>
            <div class="space-y-2 mb-4">
                @foreach ($ngo->ngo->documents as $index => $document)
                    <a href="{{ Storage::url($document) }}" target="_blank" class="text-sm text-blue-500 hover:underline">
                        <i class="fas fa-file-pdf mr-2"></i> Document {{ $index + 1 }}
                    </a>
                @endforeach
            </div>
        @endif
        @if (!$ngo->verified)
            <div class="flex space-x-4">
                <form action="{{ route('admin.ngos.verify', $ngo->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        <i class="fas fa-check mr-2"></i> Verify NGO
                    </button>
                </form>
                <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                    onclick="$('#rejectModal').removeClass('hidden')">
                    <i class="fas fa-times mr-2"></i> Reject NGO
                </button>
            </div>
            <!-- Rejection Modal -->
            <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white rounded-lg p-6 w-full max-w-md">
                    <h2 class="text-lg font-bold mb-4">Reject NGO</h2>
                    <form action="{{ route('admin.ngos.reject', $ngo->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-4">
                            <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Rejection
                                Reason</label>
                            <textarea name="rejection_reason" id="rejection_reason" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"
                                required></textarea>
                            @error('rejection_reason')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex space-x-2">
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                <i class="fas fa-times mr-2"></i> Confirm Rejection
                            </button>
                            <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400"
                                onclick="$('#rejectModal').addClass('hidden')">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <a href="{{ route('admin.ngos') }}"
            class="mt-6 inline-block px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
            <i class="fas fa-arrow-left mr-2"></i> Back to NGOs
        </a>
    </div>

@endsection
