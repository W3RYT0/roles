<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\SaveUserService;
use App\Services\UpdateUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('User.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('User.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, SaveUserService $saveuser)
    {
        $saved = $saveuser->store($request);
        // toast()->success('¡El usuario se creó con éxito!')->pushOnNextPage();
        return redirect()->action([UserController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function  edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view('User.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, UpdateUserService $updateuser, $id)
    {
        $updatedrole = $updateuser->update($request, $id);
        // toast()->success('¡Se asigno el rol correctamente!')->pushOnNextPage();
        return redirect()->action([UserController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $user)
    {
        DB::beginTransaction();
            if ($request->historico) {
                try {
                    if ($request->destruir==1) {
                        User::where('id',$user)->forceDelete();
                        // toast()->success('Registro destruido exitosamente!')->pushOnNextPage();
                    } else {
                        User::where('id',$user)->restore();
                        // toast()->success('Usuario restaurado exitosamente!')->pushOnNextPage();
                    }
                    DB::commit();
                } catch (\Throwable $e) {
                    DB::rollBack();
                    throw $e;
                }
            } else {
                try {
                    User::where('id',$user)->delete();
                //    toast()->success('Registro eliminado exitosamente!')->pushOnNextPage();
                    DB::commit();
                } catch (\Throwable $e) {
                    DB::rollBack();
                    throw $e;
                }
            }
        return redirect()->action([UserController::class, 'index']);
    }
}
