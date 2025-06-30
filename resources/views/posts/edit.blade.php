<x-layout>

    <x-glass-container>
        <form action="{{ route('posts.delete', [$post->id]) }}" method="POST" class="flex justify-end mb-3">
            @csrf
            @method('DELETE')
            <button>
                <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
            </button>
        </form>
        <form id="post-update" action="{{ route('posts.update', [$post->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <x-form-field>
                <x-form-label for="title">Title</x-form-label>
                <x-form-input id="title" name="title" type="text" placeholder="Feeling blessed" value="{{ $post->title }} " />
                <x-form-error name="title" />
            </x-form-field>
            <x-form-field>
                <x-form-label for="content">Content</x-form-label>
                <textarea id="content" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="What's on your mind..">{{ $post->content }}</textarea>
                <x-form-error name="content" />
            </x-form-field>
            <x-form-field>
                <x-form-label for="tags">Tags</x-form-label>
                <x-form-input id="tags" name="tags" type="text" placeholder="happy, blessed, enjoy, excited" value="{{ implode(', ', $tagName) }}" />
                <x-form-error name="tags" />
            </x-form-field>
        </form>
        <div class="grid grid-cols-2 gap-2 mb-3">
            @foreach ($post->attachments as $attachment)
            <div>
                <form action="{{ route('attachments.delete', [$attachment->id]) }}" method="POST" class="relative">
                    @csrf
                    @method('DELETE')
                    <img src="{{ asset('storage/' . $attachment->dir) }}" class="" />
                    <button class="bg-red-500 rounded-full absolute top-0 right-0">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        <x-form-button form="post-update">Edit Post</x-form-button>
    </x-glass-container>

</x-layout>