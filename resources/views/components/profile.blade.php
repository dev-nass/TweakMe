<x-layout rightPanel="hidden">

    <div class="grid grid-cols-1 gap-y-1">
        <section class="w-full relative mb-3 h-[200px] bg-[url('https://picsum.photos/800')] bg-cover bg-center bg-no-repeat rounded-xl shadow-md">

            <img class="bg-slate-800 absolute bottom-[-50px] left-5 p-1 w-30 h-30 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                alt="user photo">
        </section>

        <section class="flex justify-end">
            <a href="#" class="border border-indigo-500 py-2 px-4 rounded-full text-indigo-400 font-semibold">Edit Profile</a>
        </section>

        <section>
            <h1 class="text-3xl font-bold mb-2">{{ Auth::user()->username }}</h1>
            <p class="text-gray-200 mb-1">This is a sample description of this profile</p>
            <p class="text-gray-400 mb-1">
                <svg class="w-5 h-5 text-inherit inline me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                </svg>{{ Auth::user()->email }}
            </p>
            <p class="text-gray-400 mb-2">
                <svg class="w-5 h-5 text-inherit inline me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                </svg>
                Joined {{ Auth::user()->created_at->format('F d, Y') }}
            </p>
            <div class="text-gray-400 flex space-x-3">
                <a href="{{ route('friends.index', [Auth::user()->id]) }}"><span class="text-white font-semibold">{{ Auth::user()->friends->count() }}</span> Friends</a>
                <a href="{{ route('friend-request.index', [Auth::user()->id]) }}"><span class="text-white font-semibold">{{ Auth::user()->friendRequests->count() }}</span> Followers</a>
            </div>
        </section>
    </div>

    <div class="my-5">
        <nav class="grid grid-cols-4 text-center">
            <x-profile-link href="{{ route('profile.posts', ['user' => Auth::user()->id]) }}" :active="request()->routeIs('profile.posts')">Posts</x-profile-link>
            <x-profile-link href="{{ route('profile.retweaks', ['user' => Auth::user()->id]) }}" :active="request()->routeIs('profile.retweaks')">Retweaks</x-profile-link>
            <x-profile-link href="{{ route('profile.bookmarks', ['user' => Auth::user()->id]) }}" :active="request()->routeIs('profile.bookmarks')">Bookmarks</x-profile-link>
            <x-profile-link href="{{ route('profile.likes', ['user' => Auth::user()->id]) }}" :active="request()->routeIs('profile.likes')">Likes</x-profile-link>
        </nav>

        <section>
            {{ $slot }}
        </section>
    </div>



</x-layout>