<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SavePermissionService;
use Spatie\Permission\Models\Permission;
use App\Services\UpdatePermissionService;
use App\Http\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Permission.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request, SavePermissionService $savepermission)
    {
        $saved = $savepermission->store($request);
        // toast()->success('¡El permiso se generó con éxito!')->pushOnNextPage();
        return redirect()->action([PermissionController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('Permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('Permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePermissionRequest $request, UpdatePermissionService $updatepermission, $id)
    {
        $updatedpermission = $updatepermission->update($request, $id);
        // toast()->success('¡El permiso se actualizó con éxito!','Módulo de Administración')->pushOnNextPage();
        return redirect()->action([PermissionController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $permission=Permission::find($id);
            $permission->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        // toast()->success('Permiso eliminado correctamente!!','Módulo de Administración')->pushOnNextPage();
        return redirect()->action([PermissionController::class, 'index']);
    }
}
