<x-layout>

    <x-glass-container>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-field>
                <x-form-label for="title">Title</x-form-label>
                <x-form-input id="title" name="title" type="text" placeholder="Feeling blessed" />
            </x-form-field>
            <x-form-field>
                <x-form-label for="content">Content</x-form-label>
                <textarea id="message" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="What's on your mind.."></textarea>
            </x-form-field>
            <x-form-field>
                <x-form-label for="tags">Tags</x-form-label>
                <x-form-input id="tags" name="tags" type="text" placeholder="happy, blessed, enjoy, excited" />
            </x-form-field>
            <x-form-field>
                <x-form-label for="attachment">Attachment</x-form-label>
                <x-form-input id="attachment" name="attachments[]" multiple type="file" />
            </x-form-field>
            <x-form-button>Post</x-form-button>
        </form>
    </x-glass-container>

</x-layout>