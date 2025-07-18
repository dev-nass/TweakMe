
<x-layout>

    <x-glass-container>
        <form action="{{ route('comments.update', [$comment->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <textarea id="message" rows="4" class="block mb-2 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="content" placeholder="Write a comment...">{{ $comment->content }}</textarea>
            <x-form-error name="content" />
            <x-form-button>Update</x-form-button>
        </form>
    </x-glass-container>

</x-layout>