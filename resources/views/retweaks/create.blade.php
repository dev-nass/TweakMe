<x-layout>

    <x-glass-container>
        <form action="{{ route('retweaks.create', [$post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-field>
                <x-form-label for="audience">Audience</x-form-label>
                <select id="countries" name="audience" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose Audience</option>
                    <option value="public">Public</option>
                    <option value="friends">Friends</option>
                    <option value="private">Private</option>
                </select>
                <x-form-error name="audience" />
            </x-form-field>
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
            <x-glass-container class="mb-3">
                <div class="flex align-center space-x-3 mb-4">
                    <img class="w-10 h-10 rounded-full" src="{{ $post->user->profile ? asset('storage/' . $post->user->profile) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}"
                        alt="user photo">
                    <div>
                        <a href="#">{{ $post->user->username }}</a>
                        <p class="text-sm text-gray-300">{{ $post->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
                <div class="mb-3">
                    <h1 class="text-2xl font-bold mb-1">{{ $post->title }}</h1>
                    <p class="text-justify">{{ $post->content }}</p>
                </div>
                <div class="grid {{ $post->attachments->count() > 1 ? 'grid-cols-2 gap-2 mb-2' : 'grid-cols-1' }} ">
                    @foreach ($post->attachments as $attachment)
                    @if($attachment->type === 'video')
                    <video class="w-full h-full" controls>
                        <source src="{{ asset('storage/' . $attachment->dir) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @elseif($attachment->type === 'image')
                    <div>
                        <img src="{{ asset('storage/' . $attachment->dir) }}" class="" />
                    </div>
                    @endif
                    @endforeach
                </div>
            </x-glass-container>

            <x-form-button>Post</x-form-button>
        </form>
    </x-glass-container>

    <x-br />



</x-layout>