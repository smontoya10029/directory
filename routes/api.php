<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\client\EmpresaController;
use App\Http\Controllers\Api\admin\EmpresaController as EmpresaAdmin;
use App\Http\Controllers\Api\admin\UserController;
use App\Http\Controllers\Api\admin\CategoriaController;

route::prefix('v1')->group(function () {
    //publicas
    //::public
    route::get('/public/{slug}', [FrontController::class, 'categoria']);

    //::auth
    route::post('/auth/register', [AuthController::class, 'register']);
    route::post('/auth/login', [AuthController::class, 'login']);

    //privadas
    Route::group(['middleware' => 'auth:sanctum'], function () {
        //::auth
        route::post('/auth/logout', [AuthController::class, 'logout']);

        //::rol client
        route::apiResource('/client/empresa', EmpresaController::class);

        //::rol admin
        route::apiResource('/admin/empresa', EmpresaAdmin::class);
        route::apiResource('/admin/user', UserController::class);
        route::apiResource('/admin/categoria', CategoriaController::class);

    });

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
