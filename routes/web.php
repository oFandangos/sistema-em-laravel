<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AdminProdController;
use App\Http\Controllers\AdminAvisoController;

Route::get('/',[IndexController::class,'index']);

#categorias
Route::get('/cat',[CategoryController::class,'index']);
Route::get('/cat/create',[CategoryController::class,'create']);
Route::post('/cat',[CategoryController::class,'store']);
Route::get('/cat/edit/{category}',[CategoryController::class,'edit']);
Route::put('/cat/{category}/edit',[CategoryController::class,'update']);
Route::delete('/cat/{category}',[CategoryController::class,'destroy']);

#Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/', [IndexController::class,'index']);
Route::post('/logout', [LoginController::class,'logout']);

#Produtos
Route::get('/produto/create',[ProdutoController::class,'create']);
Route::post('/produto',[ProdutoController::class,'store']);
Route::get('/produto/show/{produto}', [ProdutoController::class, 'show']);
Route::get('/produto/edit/{produto}',[ProdutoController::class,'edit']);
Route::put('/produto/{produto}/edit',[ProdutoController::class,'update']);
Route::delete('/produto/{produto}',[ProdutoController::class,'destroy']);

#criacao de usuario por um admin
Route::get('/user', [UserController::class,'index']);
Route::get('/adm/create/{user}', [UserController::class,'edit']);
Route::put('/adm/{user}', [UserController::class,'update']);
Route::get('/adm/banir/{user}', [UserController::class, 'banir']);
Route::put('/adm/banido/{user}', [UserController::class,'delete']);

#avisos
Route::get('/adm/avisos', [AdminAvisoController::class,'create']);
Route::post('/adm/avisos/create', [AdminAvisoController::class,'store']);
Route::delete('/adm/avisos/delete/{aviso}', [AdminAvisoController::class,'destroy']);

#aprovar produtos
Route::get('/adm/prod-listar', [AdminProdController::class, 'index']); //form
Route::put('/adm/aprovar/{produto}', [AdminProdController::class, 'update']); //aprovar ou rejeitar um produto
Route::put('/adm/reprovar/{produto}', [AdminProdController::class, 'reprovar']);

Route::resource('files', FileController::class);