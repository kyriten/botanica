<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PlantPostController;
use App\Http\Controllers\VillageController;
use App\Models\District;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [PlantPostController::class, 'index'])->name('plant.welcome');

//Authentication Routes
///Login
Route::get('/welcome/admin', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/welcome/admin/auth', [LoginController::class, 'authenticate'])->name('auth.login');

///logout
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'admin' => AdminController::class,
        'post' => PostController::class,
        'province' => ProvinceController::class,
        'city' => CityController::class,
        'district' => DistrictController::class,
        'village' => VillageController::class,
        'map' => MapController::class
    ]);
});

Route::get('/get-province/{cityId}', [DistrictController::class, 'getProvince'])->name('get.province');
Route::get('/get-city/{cityId}', [VillageController::class, 'getCity'])->name('get.city');
Route::get('/get-city-details/{id}', [MapController::class, 'getCityDetails']);
Route::get('/get-province-details/{id}', [MapController::class, 'getProvinceDetails']);

