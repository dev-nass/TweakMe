@props(['post'])

<x-glass-container>
    <!-- post header -->
    <div class="flex align-center space-x-3 mb-4">
        <img class="w-12 h-12 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
            alt="user photo">
        <div>
            <a href="#">{{ $post->user->username }}</a>
            <div class="flex items-center space-x-1">
                @if ($post->audience === 'public')
                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.64 4.737A7.97 7.97 0 0 1 12 4a7.997 7.997 0 0 1 6.933 4.006h-.738c-.65 0-1.177.25-1.177.9 0 .33 0 2.04-2.026 2.008-1.972 0-1.972-1.732-1.972-2.008 0-1.429-.787-1.65-1.752-1.923-.374-.105-.774-.218-1.166-.411-1.004-.497-1.347-1.183-1.461-1.835ZM6 4a10.06 10.06 0 0 0-2.812 3.27A9.956 9.956 0 0 0 2 12c0 5.289 4.106 9.619 9.304 9.976l.054.004a10.12 10.12 0 0 0 1.155.007h.002a10.024 10.024 0 0 0 1.5-.19 9.925 9.925 0 0 0 2.259-.754 10.041 10.041 0 0 0 4.987-5.263A9.917 9.917 0 0 0 22 12a10.025 10.025 0 0 0-.315-2.5A10.001 10.001 0 0 0 12 2a9.964 9.964 0 0 0-6 2Zm13.372 11.113a2.575 2.575 0 0 0-.75-.112h-.217A3.405 3.405 0 0 0 15 18.405v1.014a8.027 8.027 0 0 0 4.372-4.307ZM12.114 20H12A8 8 0 0 1 5.1 7.95c.95.541 1.421 1.537 1.835 2.415.209.441.403.853.637 1.162.54.712 1.063 1.019 1.591 1.328.52.305 1.047.613 1.6 1.316 1.44 1.825 1.419 4.366 1.35 5.828Z" clip-rule="evenodd" />
                </svg>
                @elseif ($post->audience === 'friends')
                <svg class="w-4 h-4 text-gray-800 dark:text-white align-bottom" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                @elseif ($post->audience === 'private')
                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z" />
                </svg>
                @endif

                <p class="text-sm text-gray-300">{{ $post->created_at->format('F d, Y') }}</p>
            </div>
        </div>

        @can('update', $post)
        <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots-{{ $post->id }}"
            class="inline-flex items-center ml-auto p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            type="button">
            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 4 15">
                <path
                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownDots-{{ $post->id }}"
            class="z-100 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                <li>
                    <a href="{{ route('posts.edit', [$post->id]) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                </li>
            </ul>
            <div class="py-2">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Separated
                    link</a>
            </div>
        </div>
        @endcan


    </div>

    <!-- post body -->
    <div>
        <a href="{{ route('posts.show', [$post->id]) }}">
            <h1 class="text-2xl font-bold mb-1">{{ $post->title }}</h1>
            <p class="text-justify">{{ $post->content }}</p>
        </a>
        @if($post->attachments->isNotEmpty())
        <div id="gallery" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-90">
                <!-- Item 1 -->
                @foreach($post->attachments as $attachment)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/' . $attachment->dir) }}"
                        class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="">
                </div>
                @endforeach
            </div>
            @if(count($post->attachments) > 1)
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
            @endif
        </div>
        @endif

        @if ($post->is_retweak == true)
        <x-glass-container class="mb-3 mt-3">
            <div class="flex align-center space-x-3 mb-4">
                <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                    alt="user photo">
                <div>
                    <a href="#">{{ $post->retweak->user->username }}</a>
                    <p class="text-sm text-gray-300">{{ $post->created_at->format('F d, Y') }}</p>
                </div>
            </div>
            <div class="mb-3">
                <h1 class="text-2xl font-bold mb-1">{{ $post->retweak->title }}</h1>
                <p class="text-justify">{{ $post->retweak->content }}</p>
            </div>
            <div class="grid {{ $post->retweak->attachments->count() > 1 ? 'grid-cols-2 gap-2 mb-2' : 'grid-cols-1' }} ">
                @foreach ($post->retweak->attachments as $attachment)
                <div>
                    <img src="{{ asset('storage/' . $attachment->dir) }}" class="" />
                </div>
                @endforeach
            </div>
        </x-glass-container>

        @endif
    </div>

    <x-br />

    <!-- action buttons (like, comment, retweak, bookmark) -->
    <div class="flex space-x-3">
        @php
        $hasLiked = $post->likes->contains('user_id', Auth::user()->id);
        @endphp
        <button
            class="like-button flex space-x-1 py-1 px-2 rounded-xl transition duration-300 {{ Auth::user() ? 'hover:bg-gray-500' : 'cursor-not-allowed' }}"
            data-like-url="{{ route('likes.store', $post->id) }}"
            data-unlike-url="{{ route('likes.delete', $post->id) }}"
            data-post-id="{{ $post->id }}"
            data-liked="{{ $hasLiked ? 'true' : 'false' }}">
            {{ Auth::user() ? '' : 'disabled' }}
            <svg class="like-svg w-6 h-6 {{ $hasLiked ? 'fill-red-500 text-red-500' : 'text-gray-800 dark:text-white' }} " aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
            </svg>
            <span class="like-count" data-like-count="{{ $post->likes->count() }}">{{ $post->likes->count() }}</span>
            <span class="like-label">{{ $hasLiked ? 'Unlike' : 'Like' }}</span>
        </button>


        <a href="{{ route('posts.show', [$post->id]) }}"
            class="flex space-x-1 py-1 px-2 rounded-xl transition duration-300 hover:bg-gray-500">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7.556 8.5h8m-8 3.5H12m7.111-7H4.89a.896.896 0 0 0-.629.256.868.868 0 0 0-.26.619v9.25c0 .232.094.455.26.619A.896.896 0 0 0 4.89 16H9l3 4 3-4h4.111a.896.896 0 0 0 .629-.256.868.868 0 0 0 .26-.619v-9.25a.868.868 0 0 0-.26-.619.896.896 0 0 0-.63-.256Z" />
            </svg>
            <span>{{ $post->comments->count() }}</span>
            <span>Comment</span>
        </a>


        <a href="{{ route('retweaks.create', [$post->id]) }}" class="flex space-x-1 py-1 px-2 rounded-xl transition duration-300 hover:bg-gray-500">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m15.141 6 5.518 4.95a1.05 1.05 0 0 1 0 1.549l-5.612 5.088m-6.154-3.214v1.615a.95.95 0 0 0 1.525.845l5.108-4.251a1.1 1.1 0 0 0 0-1.646l-5.108-4.251a.95.95 0 0 0-1.525.846v1.7c-3.312 0-6 2.979-6 6.654v1.329a.7.7 0 0 0 1.344.353 5.174 5.174 0 0 1 4.652-3.191l.004-.003Z" />
            </svg>
            <span>{{ $post->retweaks->count() }}</span>
            <span>Retweak</span>
        </a>


        @php
        $hasBookmarked = $post->bookmarks->contains('user_id', Auth::user()->id);
        @endphp
        <button
            class="bookmarkBtns flex space-x-1 py-1 px-2 rounded-xl transition duration-300 {{ Auth::user() ? 'hover:bg-gray-500' : 'cursor-not-allowed' }}"
            data-bookmark-url="{{ route('bookmarks.store', [$post->id]) }}"
            data-unbookmark-url="{{ route('bookmarks.delete', [$post->id]) }}"
            data-post-id="{{ $post->id }}"
            data-bookmarked="{{ $hasBookmarked ? 'true' : 'false' }}">
            <svg class="bookmark-svg w-5 h-5 {{ $hasBookmarked ? 'fill-white' : '' }} text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
            </svg>
            <span class="bookmark-count">{{ $post->bookmarks->count() }}</span>
            <span class="bookmark-label">{{ $hasBookmarked ? 'Unbookmark' : 'Bookmark' }}</span>
        </button>
    </div>
</x-glass-container>