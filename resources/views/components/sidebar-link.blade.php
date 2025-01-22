@props([
  'href',
  'icon',
  'active' => false,
])

@php
    $class = $active ? 'sidebar-item active' : 'sidebar-item';
@endphp

<li {{ $attributes->merge(['class' => $class]) }}>
  <a class="sidebar-link" href="{{ $href }}">
    <i class="align-middle" data-feather="{{ $icon }}"></i> <span class="align-middle">{{ $slot }}</span>
  </a>
</li>