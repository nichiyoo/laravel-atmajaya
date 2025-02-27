@props([
    'variant' => 'default',
    'size' => 'default',
])

@php
  $source = $variant === 'default' ? 'logo-dark.png' : 'logo-white.png';
  $class = $size === 'default' ? 'logo' : 'logo-small';
  $filepath = asset($source);
@endphp

<img src="{{ $filepath }}" alt="logo" class="{{ $class }}">
