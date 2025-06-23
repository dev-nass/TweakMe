<x-layout :rightPanel="false">
    <x-glass-container class="flex space-x-2 mb-5">
        <form action="{{ route('search.user') }}" method="GET" class="w-full flex items-center space-x-2">
            @csrf
            <x-form-field class="grow">
                <x-form-input id="q" class="my-0" name="q" type="text" placeholder="Find Something..." />
            </x-form-field>
            <button class="mb-5 bg-blue-500 py-2 px-3 rounded-xl">Search</button>
        </form>
    </x-glass-container>
</x-layout>