<div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <span class="p-2 text-white">{{ $loop->iteration }} / {{  $loop->count }}</span>
    <a href="#">
        <img class="p-8 rounded-t-lg" src="https://picsum.photos/600" alt="product image" />
    </a>
    <div class="px-5 pb-5">
        <a href="#">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $slot }}</h5>
        </a>
        <div class="flex items-center mt-2.5 mb-5 gap-3">
            <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-sm dark:bg-blue-200 dark:text-blue-800 ">Comments:
                {{$post->comments_count}}</span>
            @if ($showReactions)
                <span
                    class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-sm dark:bg-blue-200 dark:text-blue-800 ">Reactions:
                    {{$post->reactions_count}}</span>
            @endif
        </div>

        <div class="flex items-center justify-between">
            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $post->user->name }}</span>
            <a href="{{ route('posts.show', $post) }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Show
                Post</a>
        </div>
    </div>
</div>