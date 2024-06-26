<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Relations\Concerns\InteractsWithPivotTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class SavePermissionService
{
    use InteractsWithPivotTable;

    public function store(Request $request)
    {  
        DB::beginTransaction();
        try {
            Permission::create([
                'name' => request()['name'],
                'description' => request()['description'],
                'group' => request()['group'],
                'guard_name' => 'web',
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
