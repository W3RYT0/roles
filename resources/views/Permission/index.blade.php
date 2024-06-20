<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium leading-tight text-center font-montserrat text-ownred">
            <span class="p-2 border rounded-full bg-slate-300 border-owngold"><i class="fa-solid fa-fingerprint"></i></span> {{ __(' Permisos') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-4 md:my-12">
        <div class="shadow-xl h-2/3 bg-slate-200 sm:rounded-lg">
            @livewire('admin.permission-component')
        </div>
    </div>
</x-app-layout>
