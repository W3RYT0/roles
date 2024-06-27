<div>
    <div class="flex flex-wrap">
        <div class="relative w-full mb-4 sm:w-1/2">
            <div class="mx-2">
                <input type="text" id="group" name="group" wire:model.live='grupo' value="{{ old('group') ?? ($permission<>'' ? $permission->group : '') }}"
                    class="block px-2.5 h-8 pb-1.5 pt-3 w-full text-sm font-montserrat text-gray-500 bg-transparent rounded-md border-1 border-indigo-100 appearance-none 
                    focus:outline-none focus:ring-0 focus:border-indigo-300 peer" placeholder="" wire:model.lazy="grupo" />
                <label for="group" class="absolute text-xs text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-5 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-3">Modelo o Grupo al que pertenece el permiso</label>
                    <span class="pt-2 pl-2 text-xs font-light text-gray-400 " id="tip_group" name="tip_group">
                        Grupos existentes:
                        {{-- {{ $grupos ?? '' }} --}}
                        @foreach ($grupos as $gr)
                        <span class="cursor-pointer" wire:click='agrega("{{$gr}}",1)'>
                            {{$gr}},
                        </span>
                    @endforeach 
                    </span>
                </div>
        </div>
        <div class="relative w-full mb-4 sm:w-1/2">
            <div class="mx-2">
                <input type="text" id="description" name="description" wire:model.live='desc' value="{{ old('description') ?? ($permission<>'' ? $permission->description : '') }}"
                    class="block px-2.5 h-8 pb-1.5 pt-3 w-full text-sm font-montserrat text-gray-500 bg-transparent rounded-md border-1 border-indigo-100 appearance-none 
                    focus:outline-none focus:ring-0 focus:border-indigo-300 peer" placeholder=" " />
                <label for="description" class="absolute text-xs text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-5 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-3">Descripción del permiso</label>
                <span class="pt-2 pl-2 text-xs font-light text-gray-400 " id="tip_description1" name="tip_description1">
                    Por ejemplo:
                    @foreach ($ejemplos as $ej)
                        
                        <span class="cursor-pointer" wire:click='agrega("{{$ej}}",2)'>
                            {{$ej}},
                        </span>
                    @endforeach
                    etc. 
                </span>
                <span class="pt-2 pl-2 text-xs font-semibold text-blue-400 " id="tip_description" name="tip_description"> {{ $tip_description ?? '' }}</span>
            </div>
        </div>
        <div class="relative w-full">
            <div class="mx-2">
                <input type="text" id="name" name="name" wire:model='name' value="{{ old('name') ?? ($permission<>'' ? $permission->name : '') }}" class="block px-2.5 h-8 pb-1.5 pt-3 w-full text-sm font-montserrat text-gray-500 bg-transparent rounded-md border-1 border-indigo-100 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-300 peer"/>
                <label for="name" class="absolute text-xs text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white px-2 peer-focus:px-2  peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-5 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-3">Nombre del permiso</label>
                    <span class="pt-2 pl-2 text-xs font-light text-gray-400 " id="tip_permission1" name="tip_permission1">Por ejemplo index_group, show_group, create_group, edit_group o destroy_group </span>
                    <span class="pt-2 pl-2 text-xs font-semibold text-blue-400 " id="tip_permission" name="tip_permission"> {{ $tip_permission ?? '' }}</span>
            </div>        
        </div>
    </div>
</div>
