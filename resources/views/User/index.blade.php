<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium leading-tight text-center font-montserrat text-ownred">
            <span class="p-2 border rounded-full bg-slate-300 border-owngold"><i class="fa-solid fa-users"></i></span> {{ __(' Usuarios') }}
        </h2>
    </x-slot>
    
    <div class="container mx-0 my-0 md:my-2 md:mx-auto">
        <div class="shadow-xl h-2/3 bg-slate-200 sm:rounded-lg">
            @livewire('admin.user-component')
        </div>
    </div>
</x-app-layout>
