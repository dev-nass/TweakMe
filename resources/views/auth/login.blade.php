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
            <form action="" method="">
                <x-form-field>
                    <x-form-label for="username">Username or Email</x-form-label>
                    <x-form-input id="email" name="username" type="text" />
                </x-form-field>
                <x-form-field>
                    <x-form-label for="password">Password</x-form-label>
                    <x-form-input id="password" name="password" type="password" />
                </x-form-field>
                <x-form-field class="text-center text-white">
                    <p>Don't have an account yet? <a href="{{ route('registration') }}" class="text-blue-500 font-semibold">Sign Up</a></p>
                </x-form-field>
                <x-form-field>
                    <x-form-button>Sign Up</x-form-button>
                </x-form-field>
            </form>
        </x-glass-container>
    </section>

</body>

</html>