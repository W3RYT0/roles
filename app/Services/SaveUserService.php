<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\Concerns\InteractsWithPivotTable;

class SaveUserService
{
    use InteractsWithPivotTable;
    
    public function store(Request $request)
    {  
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => request()['name'],
                'password' => Hash::make(request()['password']),
                'email' => strtolower(request()['email']),
            ]);
            if (isset(request()['photo'])) {
                $user->updateProfilePhoto(request()['photo']);
            }
            $user->roles()->sync($request->rol);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}

