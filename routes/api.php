<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PlataformsController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\FuelsController;
use App\Http\Controllers\MotorsController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\FavoritesController;



Route::get('/models', [ModelsController::class, 'getModels']);
Route::get('/models/{modelAuto}', [ModelsController::class, 'show']);

Route::get('/brands', [BrandsController::class, 'getBrands']);
Route::get('/plataforms', [PlataformsController::class, 'getPlataforms']);
Route::get('/colors', [ColorsController::class, 'getColors']);
Route::get('/fuels', [FuelsController::class, 'getFuels']);
Route::get('/motors', [MotorsController::class, 'getMotors']);


Route::get('/cars', [CarsController::class, 'getCars']);

Route::get('/cars/{car}', [CarsController::class, 'show']);


Route::post('/favorite', [FavoritesController::class, 'addFavorite']);
Route::post('/deleteFavorite', [FavoritesController::class, 'destroy']);
Route::get('/favorite', [FavoritesController::class, 'getFavorites']);


Route::post('/users', [UsersController::class, 'addUser']);
Route::post('/login', [UsersController::class, 'login']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/models', [ModelsController::class, 'addModel']);
    Route::patch('/models/{modelAuto}', [ModelsController::class, 'update']);
    Route::delete('/models/{modelAuto}', [ModelsController::class, 'destroy']);

    Route::patch('/cars/{car}', [CarsController::class, 'update']);
    Route::delete('/cars/{car}', [CarsController::class, 'destroy']);
    Route::post('/cars', [CarsController::class, 'addCar']);
});
