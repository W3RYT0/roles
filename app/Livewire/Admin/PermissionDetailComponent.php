<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class PermissionDetailComponent extends Component
{
    public $permission=null;
    public Permission $permiso;
    public  $tip_description, $tip_permission, $grupo, $desc, $name;
    public $ejemplos = [
        'index'  => 'Listar', 
        'show'   => 'Mostrar', 
        'create' =>'Crear', 
        'edit'   =>'Editar', 
        'delete' =>'Eliminar'
    ];

    public function mount($permission) {
        if ($this->permission) {
            $this->grupo = $this->permission->group;
            $this->existentes($this->grupo);
        }
        
        if ($permission) {
            $this->grupo= $permission->group;
            $this->desc= $permission->description;
            $this->name= $permission->name;
            
        }
    }

    public function render()
    {
        $grupos=$this->renderGrupos();
       return view('livewire.admin.permission-detail-component', compact('grupos'));
    }

    public function updatedGrupo()
    {
            $this->existentes($this->grupo);
            $this->updatedDesc();
    }

    public function updatedDesc(){
        if ($this->grupo && $this->desc) {
            $this->name = Str::lower($this->searchArray($this->desc).'_'.$this->removeSpace($this->grupo));
        }
    }

    public function existentes($grupo) {
        $groups=Permission::where('group',$grupo)->orderByDesc('description')->get();
        $descripcion='';
        $permiso='';
        foreach ($groups as $group){
            $descripcion=$group->description.', '.$descripcion;
            $permiso=$group->name.', '.$permiso;
        }
        // $this->desc = substr($descripcion,0,-2);
        $descripcion=substr($descripcion,0,-2);
        $descripciones='Permisos existentes del grupo '.$this->grupo.': '.(trim($descripcion)<>'' ? $descripcion : 'Ninguno');
        $permiso=substr($permiso,0,-2);
        $permisos='Nombres usados en el grupo '.$this->grupo.': '.(trim($permiso)<>'' ? $permiso : 'Ninguno');
        
       $this->tip_description = $descripciones;
       $this->tip_permission = $permisos;
    }

    public function renderGrupos(){
        $grupos=Permission::groupBy('group')->orderByDesc('group')->pluck('group');
        return $grupos;

    }

    public function agrega($txt,int $tipo)
    {
        switch ($tipo) {
            case 1:
                if ($this->grupo == '') {
                    # code...
                    // $this->desc = $this->desc.', '.$txt;
                    $this->grupo = $txt;
                    $this->updatedGrupo();
                }
                break;
            case 2:
                if ($this->desc == '') {
                    # code...
                    // $this->desc = $this->desc.', '.$txt;
                    $this->desc = $txt;
                    $this->updatedDesc();            
                }// dd($this->desc.''.$txt);
                break;
            
            default:
                # code...
                break;
        }
    }

    public function removeSpace($cadena){
        $frase= preg_replace(['/\s+/','/^\s|\s$/'],[''], $cadena);
        return $frase;
    }

    public function searchArray($array){
        $array=$this->removeSpace($array);
        if (in_array($array, $this->ejemplos)) {
            $frase=array_search($array, $this->ejemplos);
        }else{
            $frase=$array;
        } 
        return $frase;
    } 

}
