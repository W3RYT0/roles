<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Relations\Concerns\InteractsWithPivotTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class UpdatePermissionService
{
    use InteractsWithPivotTable;

    public function update(Request $request, $id)
    {  
        DB::beginTransaction();
        try {
            $permission = Permission::find($id);
            $permission->update($request->all());
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
