<x-layout>

    <x-glass-container>
        <form action="{{ route('posts.update', [$post->id]) }}" method="POST">
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
            <x-form-button>Edit Post</x-form-button>
        </form>
    </x-glass-container>

</x-layout>