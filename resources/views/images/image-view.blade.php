<x-app-layout>

    <div class="max-w-7xl py-12 mx-auto container">
        <div class="bg-white p-6 overflow-hidden shadow-xl sm:rounded-lg">
            <img src="{{ asset('storage/' . $image['image_path']) }}" alt="{{ $image['title'] }}"
                class="w-full h-auto max-h-[800px] object-contain">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">{{ $image['title'] }}</h3>
                <p class="mt-2 text-gray-600">{{ $image['description'] }}</p>
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-gray-600">{{ $image['views_count'] }} views</span>
                    </div>
                    @if (Auth::check() && $image['user_id'] === Auth::user()->id)
                        <form action="/images/{{ $image->image_id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    @endif
                </div>
                <div class="my-4 flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full"
                            src="https://www.gravatar.com/avatar/{{ md5($image['email']) }}?d=mp"
                            alt="{{ $image['name'] }}">
                    </div>
                    <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900">{{ $image['name'] }}</div>
                        <div class="text-sm text-gray-500">{{ $image['email'] }}</div>
                    </div>
                </div>
                <fieldset class="border-t-2 pt-3 mb-3">
                    <legend class="text-xl text-gray-700">Add a comment</legend>
                    <form action="/comments" method="POST" class="text-right mb-3">
                        @csrf
                        <textarea name="comment" rows="3" autocomplete="false" placeholder="Write down a comment here....."
                            class="w-full border-gray-400 resize-none"></textarea>
                        <input type="hidden" name="image_id" value="{{ $image->image_id }}">
                        <button type="submit"
                            class="bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-md">
                            Post a comment
                        </button>
                    </form>
                    <div>
                        @if (count($image->comments) == 0)
                            <h3 class="text-2xl text-gray-500">Be the first to comment...</h3>
                        @endif
                        @foreach ($image->comments as $comment)
                            <div class="bg-gray-100 rounded-lg p-3 my-2">
                                <div class="flex justify-start gap-3">
                                    <img class="h-10 rounded-full"
                                        src="https://www.gravatar.com/avatar/{{ md5($image['email']) }}?d=mp"
                                        alt="{{ $image['name'] }}">
                                    <div>
                                        <div class="flex justify-start flex-wrap items-baseline gap-2">
                                            <span class="text-gray-800 text-xl ">{{ $comment->user_name }}</span>
                                            <span class="text-gray-400 text-sm">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div class="text-gray-600">{{ $comment->comment }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($errors->any())
                            <div class="bg-red-50 text-red-500 p-5 my-4 rounded-lg">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</x-app-layout>
