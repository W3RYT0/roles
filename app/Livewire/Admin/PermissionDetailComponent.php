<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionDetailComponent extends Component
{
    public $permission=null;
    public  $tip_description, $tip_permission, $grupo, $desc;
    public $ejemplos = ['Listar', 'Mostrar', 'Crear', 'Editar','Autorizar', 'Eliminar'];

    public function mount() {
        if ($this->permission) {
            $this->desc = $this->permission->description;
            $this->grupo = $this->permission->group;
            $this->existentes($this->grupo);
        }
    }

    public function render()
    {
        $groups=Permission::groupBy('group')->orderByDesc('group')->pluck('group');
        $grupo='';
        foreach ($groups as $group){
            $grupo=$group.', '.$grupo;
        }
        $grupo=substr($grupo,0,-2);
        $grupos='Grupos existentes: '.(trim($grupo)<>'' ? $grupo : 'Ninguno');
       return view('livewire.admin.permission-detail-component', compact('grupos'));
    }

    public function updatedGrupo()
    {
            $this->existentes($this->grupo);
    }
    public function updatedDesc(){
        //foreach ($this->desc as $key => $d) {
            dd($this->desc);
        //}
        // if (condition) {
        //     # code...
        // }
    }

    public function existentes($grupo) {
        $groups=Permission::where('group',$grupo)->orderByDesc('description')->get();
        $descripcion='';
        $permiso='';
        foreach ($groups as $group){
            $descripcion=$group->description.', '.$descripcion;
            $permiso=$group->name.', '.$permiso;
        }
        $this->desc = substr($descripcion,0,-2);
        $descripcion=substr($descripcion,0,-2);
        $descripciones='Permisos existentes del grupo '.$this->grupo.': '.(trim($descripcion)<>'' ? $descripcion : 'Ninguno');
        $permiso=substr($permiso,0,-2);
        $permisos='Nombres usados en el grupo '.$this->grupo.': '.(trim($permiso)<>'' ? $permiso : 'Ninguno');
        
       $this->tip_description = $descripciones;
       $this->tip_permission = $permisos;
    }

    public function agrega($txt)
    {
        // dd($this->desc.''.$txt);
        $this->desc = $this->desc.', '.$txt;
    }

}
