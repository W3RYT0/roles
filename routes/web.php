<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
     'verified'
     ])->resource('users', UserController::class)->names([
    'show' => 'users.show', 'edit' => 'users.edit', 'update' => 'users.update', 'create' => 'users.create', 'store' => 'users.store', 'index' => 'users.index', 'destroy' => 'users.destroy'
]);

Route::middleware([
    'auth:sanctum', 
    'verified'
    ])->resource('roles', RoleController::class)->names('roles');

Route::middleware([
    'auth:sanctum', 
    'verified'
    ])->resource('permissions', PermissionController::class)->names([
    'show' => 'permissions.show', 'edit' => 'permissions.edit', 'update' => 'permissions.update', 'create' => 'permissions.create', 'store' => 'permissions.store', 'index' => 'permissions.index', 'destroy' => 'permissions.destroy'
]);

