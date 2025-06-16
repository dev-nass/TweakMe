<x-layout rightPanel="hidden">

    <h1>Friend Requests</h1>

    <div class="grid grid-cols-3 gap-2">
        @foreach ($requests as $request)
        <x-glass-container>
            <img class="rounded-lg w-full" src="https://picsum.photos/id/{{ random_int(1, 100) }}/200/200" alt="" />
            <div class="p-2">
                <a href="{{ route('friend-request.posts', [$request->sender_id]) }}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $request->sender->first_name . ' ' . $request->sender->last_name }}</h5>
                </a>
                <form action="{{ route('friend-request.update', [$request->id]) }}" method="POST" class="mb-2">
                    @csrf
                    @method('PUT')
                    <x-form-button>Accept</x-form-button>
                </form>
                <form action="{{ route('friend-request.delete', [$request->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="w-full border border-gray-400 bg-gray-600 rounded-lg py-2 px-3">Delete</button>
                </form>
            </div>
        </x-glass-container>
        @endforeach
    </div>
</x-layout>