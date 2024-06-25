<div>
    {{-- Barra de control "Titulo - Agregar"--}}
    <div class="grid lg:grid-cols-4 lg:gap-4 gap-1 lg:p-2 bg-white w-full rounded-t-lg shadow-md text-sm font-semibold">
        <div class=""></div>
        <div class="col-span-2 mt-2 text-lg font-medium leading-tight text-center font-montserrat text-ownred">
            <span class="p-2 border rounded-full bg-slate-300 border-owngold">
                <i class="lg:ml-1 fa-solid fa-fingerprint"></i>
            </span>
            <span class="ml-2">
                {{ __(' Permisos') }}
            </span> 
        </div>
        <div class="inline-flex lg:justify-center lg:text-end justify-center text-center lg:md:mb-0 sm:mb-2">
            <div class="justify-end  max-h-screen">
                <div class="flex text-center">
                    <a href="{{ route('permissions.create') }}" class="inline-flex px-3 py-2 mr-2 text-sm font-normal justify-center text-white rounded-lg cursor-pointer bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-montserrat">
                        <i class="mt-1 font-normal text-white fa-solid fa-plus font-montserrat"> </i>
                        <span class="ml-2">
                            Agregar
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Contenido --}}
    <div class="container mx-0 my-0 md:mx-auto">
        <div class="shadow-xl h-2/3 bg-slate-200 sm:rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-2 ml-2">
                {{-- @foreach ($permissions as $permission) --}}
                @forelse ($permissions as $permission)
                    <!--  Card Permisos -->
                    <div class="my-4 bg-white rounded-lg overflow-hidden shadow-lg">
                        <div class="p-1 bg-blue-200"></div>
                        <div class="p-2">
                            <h2 class="text-center font-bold text-gray-800 mb-2">{{$permission->group}}</h2>
                            <p class=" text-gray-600 mb-2 text-center">{{ $permission->description }}</p>
                        </div>
                        <div class="inline-flex grid grid-cols-3 gap-1 justify-center">
                            <div class="text-center ">
                                {{-- <a wire:click="showPermission({{$permission->id}})" --}}
                                <a wire:click="showPermission({{$permission->id}})" class="text-sm font-normal text-center cursor-pointer font-montserrat" title="Mostrar permiso">
                                    <i class=" fa-solid fa-sm fa-eye text-yellow-500 transition-transform transform hover:scale-125 hover:text-yellow-600"></i>
                                </a>
                            </div>
                            <div class="text-center ">
                                {{-- <a href="{{ route('permissions.edit', $permission) }}" --}}
                                <a href="{{ route('permissions.edit', $permission) }}" class="text-sm font-normal text-center cursor-pointer font-montserrat" title="Modificar información">
                                    <i class=" fa-solid fa-sm fa-user-pen text-lime-500 transition-transform transform hover:scale-125 hover:text-lime-600"></i>
                                </a>
                            </div>
                            <div class="text-center ">
                                {{-- <a wire:click="confirmPermissionDeletion({{$permission->id}})" --}}
                                <a wire:click="showPermission({{$permission->id}})" class="text-sm font-normal text-center cursor-pointer font-montserrat" title="Borrar registro">
                                    <i class=" text-red-500 fa-sm fa-solid fa-user-xmark transition-transform transform hover:scale-125 hover:text-red-600"></i>
                                </a> 
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-6 w-full text-center font-bold text-2x1 ">
                        Sin permisos                    
                    </div>                     
                @endforelse
            </div>
        </div>
    </div>
    
    {{-- Diálogo show --}}
    <x-dialog-modal wire:model.live="isOpenModalShowPermission" maxWidth="lg">
        @include('livewire.admin.modalPermissionShow', $permission ?? [])
    </x-dialog-modal>
    {{-- Diálogo confirmación Borrar Permiso --}}
    <x-dialog-modal wire:model="isOpenPermissionDeletion">
        <x-slot name="title">
            {{ __('Eliminar Permiso: '.$_permission) }}<span class="text-xs font-normal font-montserrat"> </span>
        </x-slot>
        <x-slot name="content">
            <i class="pl-2 text-lg text-yellow-400 fa-solid fa-circle-exclamation"></i>
            <span class="text-red-600">
                {{ __('¿Estás seguro de borrar el registro de forma permanente? Esta acción no puede deshacerse. ') }} 
            </span>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpenPermissionDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }} 
            </x-secondary-button>
            <form action="{{ route('permissions.destroy', $isOpenPermissionDeletion) }}" method="post">
                @csrf
                @method('DELETE')
                @unless ($deleteMessage != '')
                    <x-danger-button type="submit" class="ml-2" wire:loading.attr="disabled">
                        {{ __('Eliminar Permiso') }}
                    </x-danger-button>
                @endunless
            </form>
        </x-slot>
    </x-dialog-modal> 
</div>

