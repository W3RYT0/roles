<div class=" py-4 px-2 gap-2 bg-white border border-gray-100 rounded-lg shadow-md">
    <x-validation-errors class="mb-2" />
    @livewire('admin.permission-detail-component', ["permission" => $permission ?? ''])
</div>
<input type="hidden" name="id" value=" {{ isset($permission) ? $permission->id : '' }}">
<div class="flex items-center justify-end flex-1 m-6 ">
    <x-button>
        <a href="{{ route('permissions.index') }}">
            <i class="py-1 mr-2 fa-solid fa-reply"></i>{{ __('Retornar') }}
        </a>
    </x-button>
    <x-button class="ml-4 button-prevent-multiple-submits ">
        <i class="py-1 mr-2 fa-solid fa-floppy-disk"></i> {{ __('Guardar') }}
    </x-button>
</div>
