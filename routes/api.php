<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\MaterialesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//routes for categorias
Route::get('categories',[CategoriasController::class,'index']);
Route::post('categories',[CategoriasController::class,'store']);
Route::put('categories/{id}',[CategoriasController::class,'update']);
Route::delete('categories/{id}',[CategoriasController::class,'destroy']);
Route::get('categories/{id}',[CategoriasController::class,'show']);
//routes for materiales

Route::get('materials',[MaterialesController::class,'index']);
Route::post('materials',[MaterialesController::class,'store']);
Route::put('materials/{id}',[MaterialesController::class,'update']);
Route::delete('materials/{id}',[MaterialesController::class,'destroy']);
Route::get('materials/{id}',[MaterialesController::class,'show']);
