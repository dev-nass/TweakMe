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
        @foreach ($posts as $post)
        <!-- only renders if the post poster is a friend of current auth user or if the post is public -->
        @if ($post->user->friends->contains('receiver_id', Auth::user()->id) || $post->audience === 'public')
            <x-post-container :post="$post" />
        @endif
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