@props(['name', 'value'])

<textarea {{ $attributes->merge(['class' => 'form-control ckeditor ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
  id="ckeditor" name="{{ $name }}">{!! $value !!}</textarea>

@error($name)
  <div class="invalid-feedback">{{ $message }}</div>
@enderror