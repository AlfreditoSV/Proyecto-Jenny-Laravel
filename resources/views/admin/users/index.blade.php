<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de productos') }}
        </h2>
    </x-slot>
    <div class=" bg-white rounded-md shadow-md lg:flex-row md:justify-between dark:bg-dark-eval-1">
        @livewire('users.users')
    </div>

    
</x-app-layout>


