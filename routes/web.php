<?php

use Illuminate\Support\Facades\Route;
//use Spatie\Permission\Models\Role;

//$role = Role::Create(['name' => 'admin']);
//$role = Role::Create(['name' => 'client']);

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
