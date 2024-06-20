<x-slot name="title">
    <div class="object-center">
        {{$permiso->name ?? ''}}
    </div>
</x-slot>
<x-slot name="content">
    <div class="grid grid-cols-3 py-4 px-2 gap-2 bg-white border border-gray-100 rounded-lg shadow-md">
        <div class="col-span-3 py-2 text-sm font-semibold">Grupo</div>
        <div class="col-span-3 py-2">{{$permiso->group ?? ''}}</div>
        <div class="col-span-3 py-2"><hr></div>
        <div class="col-span-3 py-2 text-sm font-semibold">Descripción</div>
        <div class="col-span-3 py-2">{{$permiso->description ?? ''}}</div>
    </div>
</x-slot>
<x-slot name="footer">
    <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
        {{ __('Cancelar') }}
    </x-secondary-button>
</x-slot>