<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium leading-tight text-center font-montserrat text-ownred">
            <span class="p-2 border rounded-full bg-slate-300 border-owngold"><i class="fa-solid fa-fingerprint"></i></span> {{ __(' Editar Permiso') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-4 md:my-12">
        <div class="shadow-xl h-2/3 bg-slate-200 sm:rounded-lg px-4 py-2">
            <form name="permissions" id="permissions" method="POST" action="{{ route('permissions.update', $permission) }}" class="mt-5">
                @csrf
                @method('PUT')
                @include('Permission.forms.form')
            </form>
        </div>
    </div>
</x-app-layout>
