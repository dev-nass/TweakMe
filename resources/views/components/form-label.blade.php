
@props(['for'])

<label 
    {{ $attributes->merge([
        'for' => $for,
        'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
    ]) }}>{{ $slot }}</label>