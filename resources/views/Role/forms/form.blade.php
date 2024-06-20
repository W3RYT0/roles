<div class=" py-4 px-2 gap-2 bg-white border border-gray-100 rounded-lg shadow-md">
    <x-validation-errors class="mb-2" />
    <div class="relative">
        <input type="text" id="name" name="name" value="{{ old('name') ?? (isset($role) ? $role->name : '') }}"
            class="block px-2.5 h-8 pb-1.5 pt-3 w-full text-sm font-montserrat text-gray-500 bg-transparent rounded-md border-1 border-indigo-100 appearance-none 
            focus:outline-none focus:ring-0 focus:border-indigo-300 peer" placeholder=" " />
        <label for="name" class="absolute text-xs text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white px-2 peer-focus:px-2 
            peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 
            peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-1">Nombre del rol</label>
    </div>
</div>
<h4 class=" text-sm gap-2 px-4 py-2">Asignar permisos para</h4>
<input type="hidden" name="id" value=" {{ isset($role) ? $role->id : '' }}">
<div class="grid grid-cols-12 py-4 px-2 gap-2 bg-white border border-gray-100 rounded-lg shadow-md">
    {{$groupPrevious=''}}
    @foreach ($permissions as $permission)
        @if ($groupPrevious!=$permission->group && $groupPrevious!='')
            <div class="col-span-12 py-2"><hr></div>
        @endif
        @if ($groupPrevious!=$permission->group)
            <div class=" text-sm font-bold col-span-12 md:col-span-1">{{$permission->group}}.-</div>
        @endif
        <div class=" col-span-12 sm:col-span-1">
            <input type="checkbox" class = "h-4 w-4 text-green-400 bg-gray-100 border-gray-300
                rounded focus:ring-green-500 focus:ring-1" name="permissions[]" id="check-{{ $permission->id }}"
                {{ is_array(old('permissions')) ? (in_array($permission->id, old('permissions')) ? 'checked' : '') : 
                (collect($rolePermissions)->contains($permission->id) ? 'checked' : '') }}
                value="{{ $permission->id }}">
            <label for="check-{{ $permission->id }}" class="w-full  ml-2 text-sm font-medium text-gray-900 ">
                {{ $permission->description }}
            </label>
        </div>
        @php
            $groupPrevious=$permission->group
        @endphp
    @endforeach
</div>
<div class="flex items-center justify-end flex-1 m-6 ">
    <x-button>
        <a href="{{ route('roles.index') }}">
            <i class="py-1 mr-2 fa-solid fa-reply"></i>{{ __('Retornar') }}
        </a>
    </x-button>
    <x-button class="ml-4 button-prevent-multiple-submits ">
        <i class="py-1 mr-2 fa-solid fa-floppy-disk"></i> {{ __('Guardar') }}
    </x-button>
</div>
