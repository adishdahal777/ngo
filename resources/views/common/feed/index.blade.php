@extends('layouts.app')


@section('content')
    <!-- Stories Section -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
        <div class="flex space-x-2 overflow-x-auto scrollbar-hide">
            <!-- Create Story -->
            <div class="flex-shrink-0 w-28 h-48 bg-gray-200 rounded-lg relative cursor-pointer hover:opacity-90">
                <div class="absolute bottom-0 left-0 right-0 p-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-plus text-white"></i>
                    </div>
                    <p class="text-xs text-center font-medium">Create story</p>
                </div>
            </div>

            <!-- Story Items -->
            <div class="flex-shrink-0 w-28 h-48 bg-gray-300 rounded-lg relative cursor-pointer">
                <div class="absolute top-2 left-2 w-8 h-8 bg-blue-600 rounded-full border-4 border-white"></div>
                <div class="absolute bottom-2 left-2 right-2">
                    <p class="text-white text-xs font-medium">Anjan Shrestha</p>
                </div>
            </div>

            <div class="flex-shrink-0 w-28 h-48 bg-gray-300 rounded-lg relative cursor-pointer">
                <div class="absolute top-2 left-2 w-8 h-8 bg-blue-600 rounded-full border-4 border-white">
                </div>
                <div class="absolute bottom-2 left-2 right-2">
                    <p class="text-white text-xs font-medium">Pranish Adhikari</p>
                </div>
            </div>

            <div class="flex-shrink-0 w-28 h-48 bg-gray-300 rounded-lg relative cursor-pointer">
                <div class="absolute top-2 left-2 w-8 h-8 bg-blue-600 rounded-full border-4 border-white">
                </div>
                <div class="absolute bottom-2 left-2 right-2">
                    <p class="text-white text-xs font-medium">Nisha Singh</p>
                </div>
            </div>

            <div class="flex-shrink-0 w-28 h-48 bg-gray-300 rounded-lg relative cursor-pointer">
                <div class="absolute top-2 left-2 w-8 h-8 bg-blue-600 rounded-full border-4 border-white">
                </div>
                <div class="absolute bottom-2 left-2 right-2">
                    <p class="text-white text-xs font-medium">Bishal Chaudhary</p>
                </div>
            </div>

            <div class="flex-shrink-0 w-28 h-48 bg-gray-300 rounded-lg relative cursor-pointer">
                <div class="absolute top-2 left-2 w-8 h-8 bg-blue-600 rounded-full border-4 border-white">
                </div>
                <div class="absolute bottom-2 left-2 right-2">
                    <p class="text-white text-xs font-medium">Bigyan Zo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Post -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
            <input type="text" placeholder="What's on your mind, Adish?"
                class="flex-1 bg-gray-100 rounded-full px-4 py-2 focus:outline-none hover:bg-gray-200 cursor-pointer">
        </div>
        <div class="flex items-center justify-between pt-2 border-t border-gray-200">
            <div class="flex space-x-4">
                <button class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-video text-red-500"></i>
                    <span class="text-gray-600 font-medium">Live video</span>
                </button>
                <button class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-images text-green-500"></i>
                    <span class="text-gray-600 font-medium">Photo/video</span>
                </button>
                <button class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-smile text-yellow-500"></i>
                    <span class="text-gray-600 font-medium">Reel</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Post -->
    <div class="bg-white rounded-lg shadow-sm mb-4">
        <!-- Post Header -->
        <div class="p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gray-800 rounded-full"></div>
                <div>
                    <h3 class="font-medium text-gray-900">Routine of Nepal banda</h3>
                    <p class="text-sm text-gray-500">2m · <i class="fas fa-globe-americas"></i></p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <i class="fas fa-ellipsis-h text-gray-500"></i>
                </button>
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <i class="fas fa-times text-gray-500"></i>
                </button>
            </div>
        </div>

        <!-- Post Content -->
        <div class="px-4 pb-3">
            <p class="text-gray-900">Remember Their Names 🙏... <span class="text-blue-600 cursor-pointer">See
                    more</span></p>
        </div>

        <!-- Post Images -->
        <div class="grid grid-cols-2 gap-1">
            <div class="bg-gray-300 h-64"></div>
            <div class="grid grid-rows-2 gap-1">
                <div class="bg-gray-400 h-32"></div>
                <div class="bg-gray-500 h-32 relative">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">+51</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Post Actions -->
        <div class="p-4">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-1">
                    <div class="flex -space-x-1">
                        <div class="w-5 h-5 bg-blue-600 rounded-full border border-white flex items-center justify-center">
                            <i class="fas fa-thumbs-up text-white text-xs"></i>
                        </div>
                        <div class="w-5 h-5 bg-red-600 rounded-full border border-white flex items-center justify-center">
                            <i class="fas fa-heart text-white text-xs"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500 ml-2">1.2K</span>
                </div>
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <span>45 comments</span>
                    <span>12 shares</span>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                <button class="flex-1 flex items-center justify-center space-x-2 py-2 rounded-lg hover:bg-gray-100">
                    <i class="far fa-thumbs-up text-gray-600"></i>
                    <span class="text-gray-600 font-medium">Like</span>
                </button>
                <button class="flex-1 flex items-center justify-center space-x-2 py-2 rounded-lg hover:bg-gray-100">
                    <i class="far fa-comment text-gray-600"></i>
                    <span class="text-gray-600 font-medium">Comment</span>
                </button>
                <button class="flex-1 flex items-center justify-center space-x-2 py-2 rounded-lg hover:bg-gray-100">
                    <i class="far fa-share text-gray-600"></i>
                    <span class="text-gray-600 font-medium">Share</span>
                </button>
            </div>
        </div>
    </div>
@endsection
