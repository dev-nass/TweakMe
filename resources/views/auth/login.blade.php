<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js.app.css'])
</head>

<body class="bg-dark">
    <section class="h-full flex justify-center items-center">
        <x-glass-container class="w-1/3">
            <form action="{{ route('login-store') }}" method="POST">
                @csrf
                <x-form-field>
                    <x-form-label for="login">Username or Email</x-form-label>
                    <x-form-input id="login" name="login" type="text" :value="old('login')" />
                    <x-form-error name="login" />
                </x-form-field>
                <x-form-field>
                    <x-form-label for="password">Password</x-form-label>
                    <x-form-input id="password" name="password" type="password" />
                    <x-form-error name="password"></x-form-error>
                </x-form-field>
                <x-form-field class="text-center text-white">
                    <p>Dont have an account yet? <a href="{{ route('registration') }}" class="text-blue-500 font-semibold">Sign Up</a></p>
                </x-form-field>
                <x-form-field>
                    <x-form-button>Sign Up</x-form-button>
                </x-form-field>
            </form>
            <x-br />
            <x-form-field class="flex justify-center">
                <div class="p-3 border border-gray-300 rounded-lg">
                    <a href="{{ route('auth.google') }}">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12.037 21.998a10.313 10.313 0 0 1-7.168-3.049 9.888 9.888 0 0 1-2.868-7.118 9.947 9.947 0 0 1 3.064-6.949A10.37 10.37 0 0 1 12.212 2h.176a9.935 9.935 0 0 1 6.614 2.564L16.457 6.88a6.187 6.187 0 0 0-4.131-1.566 6.9 6.9 0 0 0-4.794 1.913 6.618 6.618 0 0 0-2.045 4.657 6.608 6.608 0 0 0 1.882 4.723 6.891 6.891 0 0 0 4.725 2.07h.143c1.41.072 2.8-.354 3.917-1.2a5.77 5.77 0 0 0 2.172-3.41l.043-.117H12.22v-3.41h9.678c.075.617.109 1.238.1 1.859-.099 5.741-4.017 9.6-9.746 9.6l-.215-.002Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </x-form-field>
        </x-glass-container>
    </section>

</body>

</html>