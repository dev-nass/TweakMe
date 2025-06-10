<x-layout>

    <x-glass-container>
        <div class="flex align-center space-x-3 mb-4">
            <img class="w-12 h-12 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
            <div>
                <a href="#">{{ $post->user->username }}</a>
                <p class="text-sm text-gray-300">{{ $post->created_at->format('F d, Y') }}</p>
            </div>
        </div>
        <div class="mb-3">
            <h1 class="text-2xl font-bold mb-1">{{ $post->title }}</h1>
            <p class="text-justify">{{ $post->description }}</p>
        </div>
        <div class="grid {{ $post->attachments->count() > 1 ? 'grid-cols-2 gap-2 mb-2' : 'grid-cols-1' }} ">
            @foreach ($post->attachments as $attachment)
            <div>
                <img src="{{ asset('storage/' . $attachment->dir) }}" class="" />
            </div>
            @endforeach
        </div>

        <x-br />
        <div class="flex space-x-3">
            @if (! $post->hasLikedByUser())
            <form action="{{ route('likes.store', [$post->id]) }}" method="POST">
                @csrf
                <button class="flex space-x-1 py-1 px-2 rounded-xl transition duration-300 hover:bg-gray-500">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                    </svg>
                    <span>{{ $post->likes->count() }}</span>
                    <span>Like</span>
                </button>
            </form>
            @elseif ($post->hasLikedByUser())
            <form action="{{ route('likes.delete', [$post->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="flex space-x-1 py-1 px-2 rounded-xl transition duration-300 hover:bg-gray-500">
                    <svg class="w-6 h-6 text-red-500 fill-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                    </svg>
                    <span>{{ $post->likes->count() }}</span>
                    <span>Like</span>
                </button>
            </form>
            @endif

            <a href="{{ route('posts.show', [$post->id]) }}" class="flex space-x-1 py-1 px-2 rounded-xl transition duration-300 hover:bg-gray-500">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.556 8.5h8m-8 3.5H12m7.111-7H4.89a.896.896 0 0 0-.629.256.868.868 0 0 0-.26.619v9.25c0 .232.094.455.26.619A.896.896 0 0 0 4.89 16H9l3 4 3-4h4.111a.896.896 0 0 0 .629-.256.868.868 0 0 0 .26-.619v-9.25a.868.868 0 0 0-.26-.619.896.896 0 0 0-.63-.256Z" />
                </svg>
                <span>12</span>
                <span>Comment</span>
            </a>
            <form action="#" method="#">
                <button class="flex space-x-1 py-1 px-2 rounded-xl transition duration-300 hover:bg-gray-500">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15.141 6 5.518 4.95a1.05 1.05 0 0 1 0 1.549l-5.612 5.088m-6.154-3.214v1.615a.95.95 0 0 0 1.525.845l5.108-4.251a1.1 1.1 0 0 0 0-1.646l-5.108-4.251a.95.95 0 0 0-1.525.846v1.7c-3.312 0-6 2.979-6 6.654v1.329a.7.7 0 0 0 1.344.353 5.174 5.174 0 0 1 4.652-3.191l.004-.003Z" />
                    </svg>
                    <span>Re-Tweak</span>
                </button>
            </form>
        </div>
    </x-glass-container>

    

</x-layout>