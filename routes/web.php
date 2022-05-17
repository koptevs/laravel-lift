<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LiftController;
use \App\Http\Controllers\LiftManagerController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::group(['middleware' => ['auth']], function (){
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('lifts', LiftController::class)->middleware('is_admin');

    Route::controller(LiftManagerController::class)->group(function () {
        Route::prefix('lift-managers')->group(function () {
            Route::name('lift-managers.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{liftManager}', 'show')->name('show');
                Route::get('/{liftManager}/edit', 'edit')->name('edit');
                Route::match(['put', 'patch'], '/{liftManager}', 'update')->name('update');
                Route::delete('/{liftManager}', 'destroy')->name('destroy');
            });
        });
    });

});

require __DIR__.'/auth.php';

