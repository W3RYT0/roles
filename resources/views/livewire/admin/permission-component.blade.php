<div>
    <div class="grid grid-cols-8 ">
        <div class="col-span-6">
            @if ($permissions->count())
                    <div class="grid grid-cols-12 py-4 px-2 gap-2 bg-white border border-gray-100 rounded-lg shadow-md">
                        {{$groupPrevious=''}}
                        @foreach ($permissions as $permission)
                            @if ($groupPrevious!=$permission->group && $groupPrevious!='')
                                <div class="col-span-12 py-2"><hr></div>
                            @endif
                            @if ($groupPrevious!=$permission->group)
                                <div class=" text-sm font-bold col-span-12 md:col-span-1">{{$permission->group}}.-</div>
                            @endif
                            <div class=" col-span-12 md:col-span-1 bg-slate-100 rounded-md">
                                <div class="w-full  ml-2 text-sm font-medium text-gray-900 text-center ">
                                    {{ $permission->description }}
                                </div>
                                <div>
                                    <a wire:click="showPermission({{$permission->id}})"
                                    class="pl-2 text-sm font-normal text-gray-500 cursor-pointer font-montserrat hover:text-gray-900 hover:bg-gray-100"
                                    title="Mostrar permiso"><i class=" fa-solid fa-sm fa-eye text-yellow-500"> </i>      
                                </a>
                                <a href="{{ route('permissions.edit', $permission) }}"
                                    class="pl-2 text-sm font-normal text-gray-500 cursor-pointer font-montserrat hover:text-gray-900 hover:bg-gray-100"
                                    title="Modificar información"><i class=" fa-solid fa-sm fa-user-pen text-lime-500"></i>
                                </a>
                                <a wire:click="confirmPermissionDeletion({{$permission->id}})"
                                    class="pl-2 text-sm font-normal text-gray-500 cursor-pointer font-montserrat hover:text-gray-900 hover:bg-gray-100"
                                    title="Borrar registro"><i class=" text-red-500 fa-sm fa-solid fa-user-xmark"></i>
                                </a> 
                                </div>
                            </div>
                            @php
                                $groupPrevious=$permission->group
                            @endphp
                        @endforeach
                    </div>
            @endif
        </div>
        <div class="col-span-2 ml-4">
            <div class="justify-between max-h-screen mt-4 ">
                <div class="flex text-center">
                    <a href="{{ route('permissions.create') }}"
                        class="inline-flex w-full px-3 py-2 mb-2 mr-2 text-sm font-normal text-center text-white rounded-lg cursor-pointer bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-montserrat">
                        <i class="pr-2 font-normal text-white fa-solid fa-plus font-montserrat"> </i>Agregar
                    </a>
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
</div>

