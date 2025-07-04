<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    @vite(['resources/css/app.css', 'resources/js.app.css'])
</head>

<body class="bg-dark">
    <section class="h-full flex justify-center items-center">
        <x-glass-container class="w-1/3">
            <form action="{{ route('registration-store') }}" method="POST">
                @csrf
                <x-form-field>
                    <x-form-label for="username">Username</x-form-label>
                    <x-form-input id="username" name="username" type="text" :value="old('username')" />
                    <x-form-error name="username" />
                </x-form-field>
                <x-form-field>
                    <x-form-group
                        for="email"
                        label="Email"
                        id="email"
                        name="email"
                        :value="old('email')"
                        type="email"
                        validation="email address" />
                    <x-form-error name="email" />
                </x-form-field>
                <x-form-field>
                    <x-form-label for="password">Password</x-form-label>
                    <x-form-input id="password" name="password" type="password" />
                    <x-form-error name="password" />
                </x-form-field>
                <x-form-field>
                    <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                    <x-form-input id="password_confirmation" name="password_confirmation" type="password" />
                </x-form-field>
                <x-form-field class="text-center text-white">
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-blue-500 font-semibold">Sign In</a></p>
                </x-form-field>
                <x-form-field>
                    <x-form-button>Sign Up</x-form-button>
                </x-form-field>
            </form>
        </x-glass-container>
    </section>

</body>

</html>