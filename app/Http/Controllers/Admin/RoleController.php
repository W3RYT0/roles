<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\SaveRoleService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Services\UpdateRoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->sortBy([
            ['group', 'asc'],
            ['description', 'asc'],
        ]);
        $rolePermissions = [];
        return view('Role.create', compact('permissions', 'rolePermissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request, SaveRoleService $saverole)
    {
        $saved = $saverole->store($request);
        // toast()->success('¡El rol se generó con éxito!')->pushOnNextPage();
        return redirect()->action([RoleController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('Role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->sortBy([
            ['group', 'asc'],
            ['description', 'asc'],
        ]);
        $rolePermissions = $role->permissions->pluck('id');
        return view('Role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoleRequest $request, UpdateRoleService $updaterole, $id)
    {
        $updatedrole = $updaterole->update($request, $id);
        // toast()->success('¡El rol se actualizó con éxito!','Módulo de Administración')->pushOnNextPage();
        return redirect()->action([RoleController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $role=Role::find($id);
            $role->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        // toast()->success('Rol eliminado correctamente!!','Módulo de Administración')->pushOnNextPage();
        return redirect()->action([RoleController::class, 'index']);
    }
}
