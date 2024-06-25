<div class="gap-2 px-2 py-4 bg-white border border-gray-100 rounded-lg shadow-md ">
    <x-validation-errors class="mb-2" />
    <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-1 gap-x-4 gap-y-1">
        <div class="col-span-2 py-2">
            <div class="relative">
                <input type="text" id="name" name="name" value="{{ old('name') ?? (isset($user) ? $user->name : '') }}" 
                    class="block px-2.5 h-9 pb-1.5 pt-3 w-full text-sm font-montserrat text-gray-500 bg-transparent rounded-md border-1 border-indigo-100 appearance-none
                    dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-indigo-300 peer"  placeholder=" " />
                <label for="name" class="absolute text-xs text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] 
                    bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 
                    peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-1">
                    Nombre del usuario</label>
            </div>
        </div>
        <div x-data="{photoName: null, photoPreview: null}" class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-1 gap-x-4 gap-y-1">
            <div class="col-span-3 py-2 -mt-2 ">
                <input type="file" name="photo" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change=" photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]); " />
                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>
            </div>
            <div class="py-2 -mt-6 ">
                @if (@isset($user))
                    <div class="w-20 mt-2 border rounded-full" x-show="! photoPreview">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="object-cover w-20 h-20 rounded-full">
                    </div>
                @endif
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block w-20 h-20 bg-center bg-no-repeat bg-cover rounded-full" x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-1 gap-x-4 gap-y-1 ">
        <div class="flex flex-row col-span-2 py-2 mb-2">
            <span class="inline-flex items-center px-3 py-1 text-sm text-gray-500 bg-gray-200 border border-indigo-100 rounded-l-md border-r-1">
                <i class="fa-solid fa-key"></i>
            </span>
            <input class="flex-auto w-full h-8 text-xs text-gray-500 border border-indigo-100 rounded-none appearance-none rounded-r-md md:text-sm focus:ring-0 focus:border-indigo-300 focus:shadow-md" id="password" name="password" type="password" placeholder="Contraseña" autocomplete="new-password" />
        </div>
        <div class="flex flex-row col-span-2 py-2 mb-2">
            <span class="inline-flex items-center px-3 py-1 text-sm text-gray-500 bg-gray-200 border border-indigo-100 rounded-l-md border-r-1">
                Confirmar
            </span>
            <input class="flex-auto w-full h-8 text-xs text-gray-500 border border-indigo-100 rounded-none appearance-none rounded-r-md md:text-sm focus:ring-0 focus:border-indigo-300 focus:shadow-md" id="password_confirmation" name="password_confirmation" type="password" placeholder="Contraseña" 
            autocomplete="off" />
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-1 gap-x-4 gap-y-1 ">
        <div class="flex flex-row col-span-2 py-2 mb-2">
            <span
                class="inline-flex items-center px-3 py-1 text-sm text-gray-500 bg-gray-200 border border-indigo-100 rounded-l-md border-r-1">
                <i class="fa-solid fa-envelope"></i>
            </span>
            <input placeholder="Correo" type="text" name="email" id="email"
                value="{{ old('email') ?? (isset($user) ? $user->email : '') }}" required
                class="flex-auto h-10 text-xs text-gray-500 border border-indigo-100 rounded-none appearance-none focus:ring-0 focus:border-indigo-300 focus:shadow-md rounded-r-md md:text-sm" />
        </div>
    </div>
    <hr>
    <input type="hidden" name="id" value=" {{ isset($user) ? $user->id : '' }}">
    <h4 class="gap-2 px-4 py-2 font-semibold text-md">Asignar rol</h4>
    <div class="gap-2 px-2 py-4 bg-white border border-gray-100 rounded-lg shadow-md ">
        <ul>
            @foreach ($roles as $rol)
            <span class="bg-">

            </span>
                <li class="rounded-lg">
                    <div >
                        <div class="px-2">
                            <div class="flex w-full mb-1 ">
                                <div class="w-auto "><label class="switch" for="check-{{ $rol->name }}">
                                    <input type="radio" id="check-{{ $rol->name }}" name="rol" value="{{ $rol->id }}"
                                        {{ old('rol') ? (old('rol') == $rol->id ? 'checked' : '') : (isset($user) ? ($user->hasAnyRole($rol->name) ? 'checked' : '') : '') }}/> 
                                        <span class="slider round"></span>
                                </label></div>
                                <div class="w-24 ml-3 text-sm font-bold text-gray-900 ">{{ $rol->name }}</div>
                                <div class="w-full ml-3 text-sm font-medium text-gray-900 ">
                                    @if ( $rol->permissions->count() == 1 )
                                        {{ $rol->permissions->count() }} Permiso 
                                    @else
                                        {{ $rol->permissions->count() }} Permisos
                                    @endif

                                    @foreach ($rol->permissions as $index =>$rolpermission)
                                    <span class="italic font-semibold ">
                                        ( {{ $rolpermission->group }}:
                                    </span>
                                     {{ $rolpermission->description }})  {{ $index+1==$rol->permissions->count() ? '' : '-'}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="pt-1"/>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="flex items-center justify-end flex-1 m-6 ">
        <x-button>
            <a href="{{ route('users.index') }}">
                <i class="py-1 mr-2 fa-solid fa-reply"></i>{{ __('Retornar') }}
            </a>
        </x-button>
        <x-button class="ml-4 button-prevent-multiple-submits ">
            <i class="py-1 mr-2 fa-solid fa-floppy-disk"></i> {{ __('Guardar') }}
        </x-button >
    </div>
</div>
