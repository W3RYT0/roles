<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleComponent extends Component
{
    public $role, $rol, $_role, $permissions, $rolePermissions, $deleteMessage;
    public $permisos=[];
    public $isOpenRoleDeletion = false;
    public $isOpenModalShowRole = false;

    use WithPagination;
    
    public function render()
    {
        $roles = Role::paginate(8);
        return view('livewire.admin.role-component', compact('roles'));
    }

    public function closeModal()
    {
        $this->isOpenModalShowRole = false;
    }

    public function showRole(Role $role)
    {
        $this->isOpenModalShowRole = $role->id;
        $this->rol = $role;
        $this->rolePermissions = $this->rol->permissions->pluck('id');
        $this->permissions = Permission::all()->sortBy([
            ['group', 'asc'],
            ['description', 'asc'],
        ]);
        $i=0;
        $this->permisos=[];
        foreach ($this->permissions as $permission){
            $i=$i+1;
            if (collect($this->rolePermissions)->contains($permission->id)) {
                $this->permisos[$i]['id']=$permission->id;
                $this->permisos[$i]['grupo']=$permission->group;
                $this->permisos[$i]['permiso']=$permission->description;
            }
        }
    }

    public function confirmRoleDeletion(Role $role)
    {
        $this->_role = $role->name;
        $this->isOpenRoleDeletion = $role->id;
    }
}

