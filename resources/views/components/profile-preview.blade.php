@props(['friendsPage' => false, 'user' => $user, 'request' => $request])

<x-layout rightPanel="hidden">

    <div class="grid grid-cols-1 gap-y-1">
        <section class="w-full relative mb-3 h-[200px] bg-[url('https://picsum.photos/800')] bg-cover bg-center bg-no-repeat rounded-xl shadow-md">

            <img class="bg-slate-800 absolute bottom-[-50px] left-5 p-1 w-30 h-30 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                alt="user photo">
        </section>

        <section class="flex justify-end space-x-2">
            @if ($request->status === 'pending')
            <form action="{{ route('friend-request.update', [$request->id]) }}" method="POST" class="mb-2">
                @csrf
                @method('PUT')
                <x-form-button>Accept</x-form-button>
            </form>
            <form action="{{ route('friend-request.delete', [$request->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="w-full border border-red-500 outline-red-500 text-red-500 rounded-lg py-2 px-3 transition duration-300 hover:bg-red-500 hover:text-white">Delete</button>
            </form>
            @elseif ($request->status === 'accepted')
            <form action="{{ route('friends.delete', [$request->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="w-full border border-red-500 outline-red-500 text-red-500 rounded-lg py-2 px-3 transition duration-300 hover:bg-red-500 hover:text-white">Unfriend</button>
            </form>
            @endif

        </section>

        <section>
            <h1 class="text-3xl font-bold mb-2">{{ $user->username }}</h1>
            <p class="text-gray-200 mb-1">This is a sample description of this profile</p>
            <p class="text-gray-400 mb-1">
                <svg class="w-5 h-5 text-inherit inline me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                </svg>{{ $user->email }}
            </p>
            <p class="text-gray-400 mb-2">
                <svg class="w-5 h-5 text-inherit inline me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                </svg>
                Joined {{ $user->created_at->format('F d, Y') }}
            </p>
            <div class="text-gray-400 flex space-x-3">
                <p><span class="text-white font-semibold">0</span> Friends</p>
                <p><span class="text-white font-semibold">0</span> Followers</p>
            </div>
        </section>
    </div>

    <div class="my-5">
        <nav class="grid grid-cols-2 text-center">
            <x-profile-link href="{{ $friendsPage ? route('friends.posts', ['user' => $user->id]) : route('friend-request.posts', ['user' => $user->id]) }}" 
                :active="request()->routeIs(['friend-request.posts', 'friends.posts'])">Posts</x-profile-link>
            <x-profile-link href="{{ $friendsPage ? route('friends.retweaks', ['user' => $user->id]) : route('friend-request.retweaks', ['user' => $user->id]) }}" 
                :active="request()->routeIs(['friend-request.retweaks', 'friends.retweaks'])">Retweaks</x-profile-link>
        </nav>

        <section>
            {{ $slot }}
        </section>
    </div>



</x-layout>