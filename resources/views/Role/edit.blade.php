<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium leading-tight text-center font-montserrat text-ownred">
            <span class="p-2 border rounded-full bg-slate-300 border-owngold"><i class="fa-solid fa-person-military-to-person"></i></span> {{ __(' Editar Rol') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-4 md:my-12">
        <div class="shadow-xl h-2/3 bg-slate-200 sm:rounded-lg px-4 py-2">
            <form name="roles" id="roles" method="POST" action="{{ route('roles.update', $role) }}" class="mt-5">
                @csrf
                @method('PUT')
                @include('Role.forms.form')
            </form>
        </div>
    </div>
</x-app-layout>
