<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-3">
                        <h1 class="text-2xl">Image Gallery</h1>
                        <a href="/add" class="bg-gray-200 px-4 py-2 shadow-md rounded-md text-gray-700"> 
                            <i class="fa fa-plus"></i> &nbsp;Add Image
                        </a>
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        @foreach($images as $image)
                            <a href="#" class="bg-gray-200 relative rounded-lg overflow-hidden shadow-md">
                                <img src="{{ $image['url'] }}" alt="{{ $image['name'] }}" class="w-full">
                                <div class="p-4 pt-5 absolute top-0 left-0 w-full h-full flex flex-col gap-2 justify-end bg-gradient-to-t from-slate-950 opacity-0 hover:opacity-100 duration-300">
                                    <h2 class="font-bold text-lg text-gray-200">{{ $image['name'] }}</h2>
                                    <p class="text-gray-300 line-clamp-3 leading-tight">{{ $image['description'] }}</p>
                                    <p class="text-gray-400 text-sm">Total Views: {{ $image['views'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
