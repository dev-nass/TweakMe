<x-profile :friendsPage="true" :user="$user" :request="$request" :ownProfile="$ownProfile">

    <div class="pt-6 grid grid-cols-1 gap-y-4">
        @if ($posts->isNotEmpty())
        @foreach ($posts as $post)
        
        <x-post-container :post="$post" />

        @endforeach
        @else
        <p class="mt-10 text-center">No posts yet</p>
        @endif
    </div>

</x-profile>


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