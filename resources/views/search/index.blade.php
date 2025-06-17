<x-layout :rightPanel="false">
    <x-glass-container class="flex space-x-2 mb-5">
        <form action="{{ route('search.user') }}" method="GET" class="flex-1/2">
            @csrf
            <x-form-field>
                <x-form-input id="q" class="my-0" name="q" type="text" placeholder="Find Something..." />
            </x-form-field>
            <button>Search</button>
        </form>
    </x-glass-container>
</x-layout>