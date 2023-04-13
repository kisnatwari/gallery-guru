<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Image Details') }}</h2>
    </x-slot>
  
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <img src="{{ asset('storage/'.$image['image_path']) }}" alt="{{ $image['title'] }}" class="w-full h-auto max-h-[800px] object-contain">
        <div class="p-6">
          <h3 class="text-lg font-medium text-gray-900">{{ $image['title'] }}</h3>
          <p class="mt-2 text-gray-600">{{ $image['description'] }}</p>
          <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">{{ $image['views_count'] }} views</span>
            </div>
            @if (Auth::check() && $image['user_id'] === Auth::user()->id)
              <form method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
              </form>
            @endif
          </div>
          <div class="mt-4 flex items-center">
            <div class="flex-shrink-0">
              <img class="h-10 w-10 rounded-full" src="https://www.gravatar.com/avatar/{{ md5($image['email']) }}?d=mp" alt="{{ $image['name'] }}">
            </div>
            <div class="ml-3">
              <div class="text-sm font-medium text-gray-900">{{ $image['name'] }}</div>
              <div class="text-sm text-gray-500">{{ $image['email'] }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>
