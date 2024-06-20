<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if(Route::current()->getName() == 'users.store'  ){
            return [
                'email' => 'required|email|unique:App\Models\User,email',
                'name' => 'required|max:30|unique:App\Models\User,name',
                'password' => 'required|confirmed|min:8|max:20',
                'photo' => 'nullable', 'mimes:jpg,jpeg,png', 'max:1024',
            ];
        } else {
            return [
                'email' => 'required|email|unique:App\Models\User,email,'.$this->id,
                'name' => 'required|max:30|unique:App\Models\User,name,'.$this->id,
                'password' => 'nullable|confirmed|min:8|max:20',
                'photo' => 'nullable', 'mimes:jpg,jpeg,png', 'max:1024',
            ];
        }
    }
    
}
