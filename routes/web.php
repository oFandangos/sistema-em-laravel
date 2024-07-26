<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;

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
Route::get('/adm/create', [UserController::class,'edit']);
Route::put('/adm', [UserController::class,'update']);
Route::get('/adm/banir', [UserController::class, 'banir']);
Route::put('/adm/banido', [UserController::class,'delete']);
