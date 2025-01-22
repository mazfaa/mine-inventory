@props(['name', 'value'])

<input type="text" {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
  id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" autocomplete="off" autofocus />

@error($name)
  <div class="invalid-feedback">{{ $message }}</div>
@enderror