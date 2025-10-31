<!-- resources/views/components/input.blade.php -->
@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md border-cyan-300 focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50']) !!}>