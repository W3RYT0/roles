<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium leading-tight text-center font-montserrat text-ownred">
            <span class="p-2 border rounded-full bg-slate-300 border-owngold"><i class="mx-1 fa-solid fa-user"></i></span> {{ __(' Editar usuario') }}
        </h2>
    </x-slot>
    
    <div class="container mx-auto my-4 md:my-3">
        <div class="shadow-xl h-2/3 bg-slate-200 sm:rounded-lg px-4 py-2">
            <form name="roles" id="roles" method="POST" class="space-y-2"  class="mt-5 form-prevent-multiple-submits"  enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                @include('User.forms.form')
            </form>
        </div>
    </div>
</x-app-layout>
