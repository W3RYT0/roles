<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\Concerns\InteractsWithPivotTable;

class UpdateUserService
{
    use InteractsWithPivotTable;
    
    public function update(Request $request, $id)
    {  
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->name = $request->name;
            if ($request->password)
            $user->password = Hash::make($request->password);
            $user->email = strtolower($request->email);
            $user->save();
            if (isset($request->photo)) {
                $user->updateProfilePhoto($request->photo);
            }
            $user->roles()->sync($request->rol);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}

