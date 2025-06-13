
@props(['active' => false])

<a {{ $attributes }} class="{{ $active ? 'text-lg text-indigo-500 border-b-2 border-b-indigo-500 pb-3 font-semibold' : 'text-lg pb-3 font-semibold transition duration-300 hover:text-indigo-500 hover:border-b-2 hover:border-indigo-500' }}"
>{{ $slot }}</a>