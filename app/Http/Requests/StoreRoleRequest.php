<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        if(Route::current()->getName() == 'roles.store'  ){
            return [
                'name' => 'required|unique:Spatie\Permission\Models\Role',
            ];
        } else {
            return [
                'name' => 'required|unique:Spatie\Permission\Models\Role,name,'.$this->id,
            ];
        }
    }
}
