<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Relations\Concerns\InteractsWithPivotTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SaveRoleService
{
    use InteractsWithPivotTable;
    
    public function store(Request $request)
    {  
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => request()['name'],
            ]);
            $role->permissions()->sync($request->permissions);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
