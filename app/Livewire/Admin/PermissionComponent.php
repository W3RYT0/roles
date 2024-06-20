<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionComponent extends Component
{
    public $role, $_permission, $permiso, $rolePermissions, $deleteMessage;
    public $permisos=[];
    public $isOpenPermissionDeletion = false;
    public $isOpenModalShowPermission = false;
    use WithPagination;

    public function render()
    {
        $permissions = Permission::orderBy('group')->orderBy('description')->get();
        return view('livewire.admin.permission-component', compact('permissions'));
    }

    public function closeModal()
    {
        $this->isOpenModalShowPermission = false;
    }

    public function showPermission(Permission $permission)
    {
        $this->isOpenModalShowPermission = $permission->id;
        $this->permiso = $permission;
    }

    public function confirmPermissionDeletion(Permission $permission)
    {
        $this->_permission = $permission->name;
        $this->isOpenPermissionDeletion = $permission->id;
    }
}

