@props(['for'])

<label for="{{ $for }}" id="{{ $for }}" {{ $attributes->merge(['class' => 'form-label']) }}>{{ $slot }}</label>