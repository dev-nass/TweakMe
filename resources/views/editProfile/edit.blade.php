<x-layout rightPanel="false">

    <x-glass-container>
        <form action="{{ route('profile-edit.update', [Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-form-field>
                <x-form-label for="profile">Profile Picture</x-form-label>
                <x-form-input id="profile" name="profile" type="file" />
            </x-form-field>
            <div class="grid grid-cols-2 gap-x-2">
                <x-form-field>
                    <x-form-label for="first_name">First Name</x-form-label>
                    <x-form-input id="first_name" name="first_name" type="text" value="{{ Auth::user()->first_name }}" />
                    <x-form-error name="first_name" />
                </x-form-field>
                <x-form-field>
                    <x-form-label for="last_name">Last Name</x-form-label>
                    <x-form-input id="last_name" name="last_name" type="text" value="{{ Auth::user()->last_name }}" />
                    <x-form-error name="last_name" />
                </x-form-field>
            </div>
            <div>
                <x-form-field>
                    <x-form-label for="username">Username</x-form-label>
                    <x-form-input id="username" name="username" type="text" value="{{ Auth::user()->username }}" />
                    <x-form-error name="username" />
                </x-form-field>
            </div>
            <div>
                <x-form-field>
                    <x-form-group
                        for="email"
                        label="Email"
                        id="email"
                        name="email"
                        value="{{ Auth::user()->email }}"
                        type="email"
                        validation="email address" />
                    <x-form-error name="email" />
                </x-form-field>
            </div>
            <div class="mb-3">
                <x-form-label for="description">Description</x-form-label>
                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tell them about you...">{{ Auth::user()->description }}</textarea>
                <x-form-error name="description" />
            </div>
            <x-form-button>Update</x-form-button>
        </form>
    </x-glass-container>
</x-layout>