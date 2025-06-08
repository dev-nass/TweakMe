@props([
'for',
'label',
'id',
'name',
'type',
'old',
'validation'])

<label class="block" for="{{ $for }}">
    <span 
        {{ $attributes->merge([
            'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
        ]) }} >{{ $label }}</span>
    <input
        {{ $attributes->merge([
        'type' => $type,
        'name' => $name,
        'value' => $old ?? null,
        'class' => "peer bg-gray-50 per border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        ]) }} />
    <p class="hidden peer-invalid:block peer-invalid:mt-2 text-sm text-red-500">Please provide a valid {{ $validation }}.</p>
</label>