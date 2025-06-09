<x-layout>

    <x-glass-container>
        <form id="post-update" action="{{ route('posts.update', [$post->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <x-form-field>
                <x-form-label for="title">Title</x-form-label>
                <x-form-input id="title" name="title" type="text" placeholder="Feeling blessed" value="{{ $post->title }}" />
            </x-form-field>
            <x-form-field>
                <x-form-label for="description">Description</x-form-label>
                <textarea id="message" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="What's on your mind..">{{ $post->description }}</textarea>
            </x-form-field>
            <x-form-field>
                <x-form-label for="tags">Tags</x-form-label>
                <x-form-input id="tags" name="tags" type="text" placeholder="happy, blessed, enjoy, excited" value="{{ implode(', ', $tagName) }}" />
            </x-form-field>
        </form>
            <div class="grid grid-cols-2 gap-2 mb-2">
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