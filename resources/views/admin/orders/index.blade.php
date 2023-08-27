<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de ordenes') }}
        </h2>
    </x-slot>
    <div class=" bg-white rounded-md shadow-md lg:flex-row md:justify-between dark:bg-dark-eval-1">
        @livewire('orders.orders-list')
    </div>
    <script src="{{asset('assets/js/app.js')}}"></script>
</x-app-layout>