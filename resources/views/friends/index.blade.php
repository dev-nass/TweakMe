<x-layout rightPanel="hidden">

    <h1>Friends Lists</h1>

    <div class="grid grid-cols-3 gap-2">
        @foreach ($requests as $request)
        <x-glass-container>
            <img class="rounded-lg w-full" src="https://picsum.photos/id/{{ random_int(1, 100) }}/200/200" alt="" />
            <div class="p-2">
                <a href="{{ route('user-profile.posts', [$request->sender_id]) }}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $request->sender->username }}</h5>
                </a>
                <form action="{{ route('friends.delete', [$request->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="w-full border border-red-500 text-red-500 rounded-lg py-2 px-3 transition duration-300 hover:bg-red-500 hover:text-white">Delete</button>
                </form>
            </div>
        </x-glass-container>
        @endforeach
    </div>
</x-layout>