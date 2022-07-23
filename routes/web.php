<?php

use App\Http\Controllers\MarkerController;
use App\Http\Controllers\NetworkMapController;
use App\Http\Controllers\TubeController;
use Illuminate\Support\Facades\Route;

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

Route::group([], function () {
    # MAP
    Route::get('/', [NetworkMapController::class, 'index'])->name('map.network');

    # NETWORK
    Route::resource('tubes', TubeController::class)->only([
        'index', 'create', 'edit',
    ]);

    # MARKER
    Route::resource('marker', MarkerController::class)->only([
        'index', 'create', 'edit',
    ]);
});
