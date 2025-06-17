<x-layout rightPanel="hidden">

    <div class="grid grid-cols-3 gap-2">
        @foreach ($users as $user)
        <x-glass-container>
            <img class="rounded-lg w-full" src="https://picsum.photos/id/{{ random_int(1, 100) }}/200/200" alt="" />
            <div class="p-2">
                <a href="{{ route('user-profile.posts', [$user->id]) }}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $user->username }}</h5>
                </a>
            </div>
        </x-glass-container>
        @endforeach
    </div>
</x-layout>