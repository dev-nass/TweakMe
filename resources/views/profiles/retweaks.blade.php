<x-profile>

    <div class="pt-6">
        @if ($retweaks->isNotEmpty())
        @foreach ($retweaks as $retweak)
        <x-glass-container>

            <!-- retweak header -->
            <div class="flex align-center space-x-3 mb-4">
                <img class="w-12 h-12 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                    alt="user photo">
                <div>
                    <a href="#">{{ $retweak->user->username }}</a>
                    <p class="text-sm text-gray-300">{{ $post->created_at->format('F d, Y') }}</p>
                </div>

                @can('update', $retweak)
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
                <div id="dropdownDots-{{ $retweak->id }}"
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
                <a href="{{ route('posts.show', [$retweak->id]) }}">
                    <h1 class="text-2xl font-bold mb-1">{{ $retweak->title }}</h1>
                    <p class="text-justify">{{ $retweak->description }}</p>
                </a>
                <div>
                    
                </div>
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
        @endforeach
        @else
        <p class="mt-10 text-center">No posts yet</p>
        @endif
    </div>

</x-profile>