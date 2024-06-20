<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Relations\Concerns\InteractsWithPivotTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UpdateRoleService
{
    use InteractsWithPivotTable;
    
    public function update(Request $request, $id)
    {  
        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->update($request->all());
            $role->permissions()->sync($request->permissions);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
