<x-layout>
    <x-glass-container>
        <div class="flex align-center space-x-3 mb-7">
            <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                alt="user photo">
            <a href="{{ route('posts.create') }}"
                class="flex justify-between grow-1 p-2 text-base font-medium text-gray-500 rounded-lg bg-gray-5 border border-gray-500 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                <span class="">What's on your mind today, Jonas?</span>
                <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 9h.01M8.99 9H9m12 3a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM6.6 13a5.5 5.5 0 0 0 10.81 0H6.6Z" />
                </svg>
            </a>
        </div>

        <div class="flex space-x-6 align-center">
            <a href="#" class="flex space-x-2">
                <svg class="w-6 h-6 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                </svg>
                <span>
                    Image/Video
                </span>
            </a>
            <a href="#" class="flex">
                <svg class="w-6 h-6 text-orange-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                </svg>

                <span>
                    Attachment
                </span>
            </a>
            <a href="#" class="flex space-x-2">
                <span class="text-green-500 font-bold text-xl">#</span>
                <span>
                    Hastag
                </span>
            </a>
            <a href="#" class="flex space-x-2">
                <span class="text-gray-500 font-bold text-xl align-top">@</span>
                <span>
                    Mentioned
                </span>
            </a>
        </div>
    </x-glass-container>

    <x-br />

    <section class="flex flex-col space-y-5">
        <x-glass-container>
            <div class="flex align-center space-x-3 mb-4">
                <img class="w-12 h-12 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                    alt="user photo">
                <div>
                    <a href="#">Adam Daniel Macawile</a>
                    <p class="text-sm text-gray-300">January 18, 2025</p>
                </div>
            </div>
            <a href="#">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Hello Guys</h1>
                    <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, minima.
                        Blanditiis, voluptate, laudantium aut quibusdam sunt adipisci molestiae doloribus quaerat vitae
                        dicta dignissimos necessitatibus error numquam hic velit nostrum excepturi!</p>
                </div>
            </a>
            <x-br />
            <div class="flex space-x-3">
                <form action="#" method="#">
                    <button class="flex space-x-1 py-1 px-2 rounded-xl transition duration-300 hover:bg-gray-500">
                        <svg class="w-6 h-6 text-red-500 fill-red-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                        </svg>
                        <span>30</span>
                        <span>Like</span>
                    </button>
                </form>
                <a href="" class="flex space-x-1 py-1 px-2 rounded-xl transition duration-300 hover:bg-gray-500">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7.556 8.5h8m-8 3.5H12m7.111-7H4.89a.896.896 0 0 0-.629.256.868.868 0 0 0-.26.619v9.25c0 .232.094.455.26.619A.896.896 0 0 0 4.89 16H9l3 4 3-4h4.111a.896.896 0 0 0 .629-.256.868.868 0 0 0 .26-.619v-9.25a.868.868 0 0 0-.26-.619.896.896 0 0 0-.63-.256Z" />
                    </svg>
                    <span>12</span>
                    <span>Comment</span>
                </a>
                <form action="#" method="#">
                    <button class="flex space-x-1 py-1 px-2 rounded-xl transition duration-300 hover:bg-gray-500">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m15.141 6 5.518 4.95a1.05 1.05 0 0 1 0 1.549l-5.612 5.088m-6.154-3.214v1.615a.95.95 0 0 0 1.525.845l5.108-4.251a1.1 1.1 0 0 0 0-1.646l-5.108-4.251a.95.95 0 0 0-1.525.846v1.7c-3.312 0-6 2.979-6 6.654v1.329a.7.7 0 0 0 1.344.353 5.174 5.174 0 0 1 4.652-3.191l.004-.003Z" />
                        </svg>
                        <span>Re-Tweak</span>
                    </button>
                </form>
            </div>
        </x-glass-container>

        @foreach ($posts as $post)
        <x-glass-container>
            <div class="flex align-center space-x-3 mb-4">
                <img class="w-12 h-12 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                    alt="user photo">
                <div>
                    <a href="#">{{ $post->user->username }}</a>
                    <p class="text-sm text-gray-300">{{ $post->created_at->format('F d, Y') }}</p>
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
            <div>
                <a href="{{ route('posts.show', [$post->id]) }}">
                    <h1 class="text-2xl font-bold mb-1">{{ $post->title }}</h1>
                    <p class="text-justify">{{ $post->description }}</p>
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
            </div>

            <x-br />
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




    </section>




</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.like-button');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const likeLabel = button.querySelector('.like-label');
                const likeSvg = button.querySelector('.like-svg');
                const likeCount = button.querySelector('.like-count');

                const postId = button.dataset.postId;
                const liked = button.dataset.liked === 'true';
                const method = liked ? 'DELETE' : 'POST';
                const url = liked ?
                    button.dataset.unlikeUrl :
                    button.dataset.likeUrl

                console.log(url);

                fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        likeLabel.textContent = liked ? 'Like' : 'Unlike';
                        button.dataset.liked = liked ? 'false' : 'true';
                        if (liked) {
                            likeSvg.classList.remove('fill-red-500', 'text-red-500');
                            likeSvg.classList.add('text-gray-800', 'dark:text-white');
                            // likeCount.textContent = '';
                            // likeCount.textContent = likeCount.dataset.likeCount -= 1;
                        } else {
                            likeSvg.classList.remove('text-gray-800', 'dark:text-white');
                            likeSvg.classList.add('fill-red-500', 'text-red-500');
                            // likeCount.textContent = '';
                            // likeCount.textContent = eval(likeCount.dataset.likeCount += 1);
                        }

                        let count = parseInt(likeCount.dataset.likeCount, 10) || 0;
                        count = liked ? count - 1 : count + 1;
                        likeCount.dataset.likeCount = count;
                        likeCount.textContent = count;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const bookmarkBtns = document.querySelectorAll('.bookmarkBtns');

        bookmarkBtns.forEach(button => {
            button.addEventListener('click', () => {
                let bookmarkSvg = button.querySelector('.bookmark-svg');
                let bookmarkCount = button.querySelector('.bookmark-count');
                let bookmarkLabel = button.querySelector('.bookmark-label');

                const postId = button.dataset.postId;
                const bookmarked = button.dataset.bookmarked === 'true';
                const method = bookmarked ? 'DELETE' : 'POST';
                const url = bookmarked ?
                    button.dataset.unbookmarkUrl :
                    button.dataset.bookmarkUrl

                fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        bookmarkLabel.textContent = bookmarked ? 'Bookmark' : 'Unbookmark';
                        button.dataset.bookmarked = bookmarked ? false : true;

                        if (bookmarked) {
                            bookmarkSvg.classList.remove('fill-white');
                        } else {
                            bookmarkSvg.classList.add('fill-white');
                        }

                        let count = parseInt(bookmarkCount.textContent, 10) || 0;
                        count = bookmarked ? count - 1 : count + 1;
                        bookmarkCount.textContent = count;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    });
</script>