<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if(Route::current()->getName() == 'permissions.store'  ){
            return [
                'name' => 'required|unique:Spatie\Permission\Models\Permission',
                'description' => 'required',
                'group' => 'required',
            ];
        } else {
            return [
                'name' => 'required|unique:Spatie\Permission\Models\Permission,name,'.$this->id,
                'description' => 'required',
                'group' => 'required',
            ];
        }
    }
}
