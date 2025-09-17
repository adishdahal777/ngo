@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('people.ngo.search') }}" id="searchForm">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">NGO Name</label>
                    <input type="text" name="name" id="name" value="{{ request('name') }}"
                        placeholder="Enter NGO name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" id="location" value="{{ request('location') }}"
                        placeholder="Enter location"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" id="category"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <span class="iconify inline mr-2" data-icon="fluent:search-20-filled" data-width="20"
                            data-height="20"></span>
                        Search
                    </button>
                    <a href="{{ route('people.ngo.search') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Clear</a>
                </div>
            </div>

            <!-- Subcategory Filter (shown when category is selected) -->
            @if (request('category'))
                <div class="mt-4">
                    <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-1">Sub Category</label>
                    <select name="subcategory" id="subcategory"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">All Sub Categories</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory }}"
                                {{ request('subcategory') == $subcategory ? 'selected' : '' }}>{{ $subcategory }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h2 class="text-lg font-medium">Search Results</h2>
            <p class="text-sm text-gray-600 mt-1">{{ $ngos->total() }} NGO{{ $ngos->total() != 1 ? 's' : '' }} found
            </p>
        </div>

        @if ($ngos->isEmpty())
            <div class="p-6 text-center text-gray-500">
                <span class="iconify text-4xl mb-2 block" data-icon="fluent:search-48-filled" data-width="48"
                    data-height="48" style="color: #9ca3af;"></span>
                <p>No NGOs found matching your criteria.</p>
                <p class="text-sm">Try adjusting your search filters.</p>
            </div>
        @else
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($ngos as $ngo)
                        <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                            <div class="p-4">
                                <div class="flex items-start space-x-3">
                                    <div class="w-12 h-12 bg-orange-500 rounded-lg overflow-hidden flex-shrink-0">
                                        @if ($ngo->logo)
                                            <img src="{{ asset('storage/' . $ngo->logo) }}" alt="{{ $ngo->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <span class="iconify w-full h-full flex items-center justify-center"
                                                data-icon="fluent:people-community-20-filled" data-width="24"
                                                data-height="24" style="color: #ffffff;"></span>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-medium text-gray-900 truncate">{{ $ngo->name }}</h3>
                                        @if ($ngo->category)
                                            <p class="text-sm text-gray-500">{{ $ngo->category }}</p>
                                        @endif
                                        @if ($ngo->location)
                                            <p class="text-sm text-gray-500">{{ $ngo->location }}</p>
                                        @endif
                                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $ngo->description }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('people.ngo.profile', $ngo->id) }}"
                                        class="text-orange-500 hover:text-orange-600 text-sm font-medium">
                                        View Profile
                                    </a>
                                    @if (auth()->user()->favoriteNgos()->where('ngo_id', $ngo->id)->exists())
                                        <span class="text-orange-500 text-sm">★ Favorited</span>
                                    @else
                                        <form action="{{ route('people.ngo.favorite', $ngo->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-orange-500 hover:text-orange-600 text-sm font-medium">★
                                                Favorite</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $ngos->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            let searchTimeout;
            $('#name, #location').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    $('#searchForm').submit();
                }, 500);
            });

            $('#category').on('change', function() {
                $('#searchForm').submit();
            });

            $('#subcategory').on('change', function() {
                $('#searchForm').submit();
            });
        });
    </script>
@endpush
