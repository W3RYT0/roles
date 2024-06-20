<x-slot name="title">
    <div class="object-center">
        {{$rol->name ?? ''}}
    </div>
</x-slot>
<x-slot name="content">
    <div class="grid grid-cols-3 py-4 px-2 gap-2 bg-white border border-gray-100 rounded-lg shadow-md">
    @if($permisos)
        {{$groupPrevious=''}}
        @foreach ($permisos as $permission)
            @if ($groupPrevious!=$permission['grupo'] && $groupPrevious!='')
                <div class="col-span-3 py-2"><hr></div>
            @endif
            @if ($groupPrevious!=$permission['grupo'])
                <div class=" text-sm font-bold col-span-3 ">{{$permission['grupo']}}.-</div>
            @endif           
            <div class=" col-span-3 sm:col-span-1">
                {{ collect($rolePermissions)->contains($permission['id']) ? $permission['permiso'] : '' }}
            </div>
            @php
                $groupPrevious=$permission['grupo']
            @endphp
        @endforeach
    @else
        <div class="col-span-3 py-2">Sin permisos asignados</div>
    @endif
    </div>
</x-slot>
<x-slot name="footer">
    <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
        {{ __('Cancelar') }}
    </x-secondary-button>
</x-slot>
