<?php

use App\Http\Controllers\API\MarkerController;
use App\Http\Controllers\API\TubeController;
use App\Http\Controllers\CableLineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.'], function () {
    # TUBES
    Route::resource('tubes', TubeController::class);

    # MARKERS
    Route::resource('markers', MarkerController::class);

    Route::resource('cablelines', CableLineController::class);

    /**
     *
     */
    Route::get('helpers/findcablehasjc/{tube:uuid}', [CableLineController::class, 'findCableHasJC'])->name('helpers.cable.hasjc');
});
