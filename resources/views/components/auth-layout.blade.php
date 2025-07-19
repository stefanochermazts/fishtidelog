@props(['title' => 'Autenticazione'])

<x-auth-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    
    {{ $slot }}
</x-auth-layout> 