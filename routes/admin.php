<?php

use Illuminate\Support\Facades\Route;
use illuminate\Http\Request;

use App\Http\Controllers\LanguesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\TypeContenusController;
use App\Http\Controllers\TypeMediasController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MediasController;
use App\Http\Controllers\ContenusController;
use App\Http\Controllers\CommentairesController;
use App\Http\Controllers\HomeController;





Route::prefix('/admin')->middleware('admin')->group(function () {

Route::get('/', [HomeController::class, 'index'])->name('home');
    
Route::resource('langues',LanguesController::class);

Route::resource('regions',RegionsController::class);

Route::resource('typecontenus',TypeContenusController::class);

Route::resource('typemedias',TypeMediasController::class);

Route::resource('roles',RolesController::class);

Route::resource('users',UsersController::class);

Route::resource('medias',MediasController::class);

Route::resource('contenus',ContenusController::class);

Route::resource('commentaires',CommentairesController::class);

});
