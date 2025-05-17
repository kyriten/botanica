<?php

use App\Models\District;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PlantPostController;

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

// Login
Route::get('/welcome/admin', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/welcome/admin/auth', [LoginController::class, 'authenticate'])->name('auth.login');

// Logout
Route::post('/logout', [LoginController::class, 'logout']);

// Authenticated Route
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

    Route::post('/delete-spots', [MapController::class, 'deleteSpots']);
    Route::put('/map/update/{id}', [MapController::class, 'update'])->name('map.updateData');
    Route::post('/import-from-excel/data/spot/tanaman', [MapController::class, 'import'])->name('map.import');
    Route::get('/export-to-excel/data/spot/tanaman', [MapController::class, 'export'])->name('map.export');
    Route::post('/set-garden-session', [MapController::class, 'setGardenSession']);
    Route::get('/profil/{username}', [AdminController::class, 'profileShow'])->name('admin.profile.show');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


// Public Route
// Route::get('/', [PublicController::class, 'landing'])->name('public.landing');
Route::get('/search', [PublicController::class, 'search'])->name('public.search');
Route::get('/tanaman/{id}', [PublicController::class, 'show'])->name('plant.show');
Route::get('/autocomplete', [PublicController::class, 'autocomplete'])->name('plant.autocomplete');

Route::get('/', [PublicController::class, 'index'])->name('public.index');


// API
Route::get('/map/{id}/data', [MapController::class, 'getData']);
Route::get('/get-province/{cityId}', [DistrictController::class, 'getProvince'])->name('get.province');
Route::get('/get-city/{cityId}', [VillageController::class, 'getCity'])->name('get.city');
Route::get('/get-city-details/{id}', [MapController::class, 'getCityDetails']);
Route::get('/get-province-details/{id}', [MapController::class, 'getProvinceDetails']);
