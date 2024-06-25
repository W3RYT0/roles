<div>
    {{-- Barra de control "Activos - Bajas  Agregar"--}}
    <div class="grid lg:grid-cols-4 lg:gap-4 gap-1 lg:p-2 bg-white w-full rounded-t-lg shadow-md text-sm font-semibold">
        <div class=""></div>
        <div class="inline-flex lg:mt-2  lg:col-start-2 lg:col-end-4 text-center justify-center">
                <span class="px-2 text-owngreen {{ $historicos==1 ? 'text-opacity-20' : '' }}">Activos </span>
                <label class="mb-1 mt-1 inline-flex items-center cursor-pointer switch" for="previous">
                    <input type="checkbox" id="previous" name="previous" value="1" wire:model.lazy="historicos" />
                    <span class="sliderb round"></span>
                </label>
                <span class="px-2 text-owngold {{ $historicos<>1 ? 'text-opacity-20' : '' }}">Bajas</span>
        </div>
        <div class="inline-flex lg:justify-end lg:text-end justify-center text-center lg:md:mb-0 sm:mb-2">
            <div class="justify-end  max-h-screen">
                <div class="flex text-center">
                    <a href="{{ route('users.create') }}"
                        class="inline-flex px-3 py-2 mr-2 text-sm font-normal justify-center text-white rounded-lg cursor-pointer 
                        bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none
                        focus:ring-green-300 font-montserrat">
                        <i class="mt-1 font-normal text-white fa-solid fa-plus font-montserrat"> </i>
                        <span class="ml-2">
                            Agregar
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Users Content --}}
    <div class="grid lg:grid-cols-4 lg:gap-2 md:grid-cols-2 md:gap-2 gap-1 lg:p-2 md:p-1">
        {{-- User Card --}}
        @forelse ($users as $user)
        <div class="bg-gray-300 rounded-lg">
            <div class="grid grid-cols-4">
                {{-- Rol asignado --}}
                <div class="pl-1 col-span-3 font-semibold">
                    @if ($user->roles->first())
                        {{$user->roles->first()->name}}
                    @else
                        <span class="text-red-800">
                            Sin Rol Asignado
                        </span> 
                    @endif
                </div>
                <div class=" justify-end text-end pr-2">
                    {{-- User Controls --}}
                    @if ($historicos==1)
                        <div class="inline-flex top-1 right-6">
                            <a wire:click="confirmUserRestauration({{$user->id}})" title="Restaurar usuario"
                                class="block pl-1 text-sm font-normal text-gray-500 cursor-pointer font-montserrat hover:text-gray-900 hover:bg-gray-100 hover:rounded-full">
                                <i class="pr-2 fa-solid fa-recycle text-lime-500 hover:text-lime-800"></i>
                            </a>
                        </div>
                        <div class="inline-flex top-1 right-0">
                            <a wire:click="confirmUserDestruction({{$user->id}})" title="Destruir registro"
                                class="block pl-1 text-sm font-normal text-gray-500 cursor-pointer font-montserrat hover:text-gray-900 hover:bg-gray-100 hover:rounded-full">
                                <i class="pr-2 text-red-500 hover:text-red-800 fa-sm fa-solid fa-user-slash"></i>
                            </a>
                        </div>
                    @else
                        <div class="inline-flex top-1 right-6">
                            <a href="{{ route('users.edit', $user->id) }}" title="Modificar información"
                                class="block pl-1 text-sm font-normal text-gray-500 cursor-pointer font-montserrat hover:text-gray-900 hover:bg-gray-100 hover:rounded-full">
                                <i class="pr-2 fa-solid fa-sm fa-user-pen text-lime-500 hover:text-lime-800"></i>
                            </a>
                        </div>
                        <div class="inline-flex top-1 right-0">
                            <a wire:click="confirmUserDeletion({{$user->id}})" title="Eliminar registro"
                                class="block pl-1 text-sm font-normal text-gray-500 cursor-pointer font-montserrat hover:text-gray-900 hover:bg-gray-100 hover:rounded-full">
                                <i class="pr-2 text-red-500 hover:text-red-800 fa-sm fa-solid fa-user-xmark"></i>
                            </a>
                        </div>
                    @endif
                </div>
                {{-- User Data --}}
                <div class="pl-4 py-2 items-center justify-center text-center bg-white">
                    <img src="{{ $user->profile_photo_url }}" 
                        class="p-1 border {{$historicos==1 ? 'opacity-20' : '' }} object-cover object-center rounded-full w-16 h-16" />
                </div>
                <div class="bg-white col-span-3 pt-4 w-full text-md font-normal tracking-tight font-montserrat text-slate-700">
                    <span class="pl-2 block">
                        {{ $user->name }}
                    </span>
                    <span class="pl-2 block text-sm text-gray-500">
                        {{ $user->email }}
                    </span> 
                </div>
            </div>
        </div>
        @empty
            
        @endforelse

        <div class="w-full -mb-2 text-sm font-montserrat">
            @if ($users->count())
                {{ $users->links() }}
            @endif
        </div>
    </div>

    {{-- Diálogo confirmación Soft delete al Usuario --}}
    <x-dialog-modal wire:model="isOpenUserDeletion">
        <x-slot name="title">
            {{ __('Eliminar Usuario: '.$_user) }}<span class="text-xs font-normal font-montserrat"> </span>
        </x-slot>
        <x-slot name="content">
            <i class="pl-2 text-lg text-yellow-400 fa-solid fa-circle-exclamation"></i>
            <span class="text-red-600">
                {{ __('¿Estás seguro de eliminar el usuario? ') }} 
            </span>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpenUserDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }} 
            </x-secondary-button>
            <form action="{{ route('users.destroy', $isOpenUserDeletion) }}" method="post">
                @csrf
                @method('DELETE')
                @unless ($deleteMessage != '')
                    <x-danger-button type="submit" class="ml-2" wire:loading.attr="disabled">
                        {{ __('Eliminar') }}
                    </x-danger-button>
                @endunless
            </form>
        </x-slot>
    </x-dialog-modal>
    {{-- Diálogo confirmación para eliminar al Usuario --}}
    <x-dialog-modal wire:model="isOpenUserDestruction">
        <x-slot name="title">
            {{ __('Destriur Usuario: '.$_user) }}<span class="text-xs font-normal font-montserrat"> </span>
        </x-slot>
        <x-slot name="content">
            <i class="pl-2 text-lg text-yellow-400 fa-solid fa-circle-exclamation"></i>
            <span class="text-red-600">
                {{ __('¿Estás seguro de destruir el registro? Esta acción no puede revertirse.') }} 
            </span>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpenUserDestruction', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }} 
            </x-secondary-button>
            <form action="{{ route('users.destroy', $isOpenUserDestruction) }}" method="post">
                @csrf
                @method('DELETE')
                @unless ($eliminateMessage != '')
                <input type="hidden" name="historico" id="historico" value="{{$historicos}}">
                <input type="hidden" name="destruir" id="destruir" value="1">
                    <x-danger-button type="submit" class="ml-2" wire:loading.attr="disabled">
                        {{ __('Destruir') }}
                    </x-danger-button>
                @endunless
            </form>
        </x-slot>
    </x-dialog-modal>
    {{-- Diálogo confirmación para restaurar al Usuario --}}
    <x-dialog-modal wire:model="isOpenUserRestauration">
        <x-slot name="title">
            {{ __('Restaurar Usuario: '.$_user) }}<span class="text-xs font-normal font-montserrat"> </span>
        </x-slot>
        <x-slot name="content">
            <i class="pl-2 text-lg text-yellow-400 fa-solid fa-circle-exclamation"></i>
            <span class="text-red-600">
                {{ __('¿Estás seguro de restaurar el usuario? ') }} 
            </span>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpenUserRestauration', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }} 
            </x-secondary-button>
            <form action="{{ route('users.destroy', $isOpenUserRestauration) }}" method="post">
                @csrf
                @method('DELETE')
                @unless ($restaurateMessage != '')
                <input type="hidden" name="historico" id="historico" value="{{$historicos}}">
                <input type="hidden" name="destruir" id="destruir" value="">
                    <x-danger-button type="submit" class="ml-2" wire:loading.attr="disabled">
                        {{ __('Restaurar') }}
                    </x-danger-button>
                @endunless
            </form>
        </x-slot>
    </x-dialog-modal>
    
</div>

