<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get("/clients", [\App\Http\Controllers\ClientController::class, "index"])->name('clients');
    Route::get('clients_getcustomfilterdata', [App\Http\Controllers\ClientController::class, 'getCustomFilterData'])->name('clients.getCustomFilterData');


    Route::get("clients_show", [\App\Http\Controllers\ClientController::class, "show"])->name('clients.show');
    Route::get('clients_getcustomfilterdata_show', [App\Http\Controllers\ClientController::class, 'getCustomFilterData_show'])->name('clients.getCustomFilterDataShow');

    Route::get('clients_create', [App\Http\Controllers\ClientController::class, 'create'])->name('clients.create');
    Route::get('clients_edit/{id}', [App\Http\Controllers\ClientController::class, 'edit'])->name('clients.edit');
    Route::get('clients_delete/{id}', [App\Http\Controllers\ClientController::class, 'delete'])->name('clients.detete');

    Route::post('clients_store', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
    Route::post('clients_update', [App\Http\Controllers\ClientController::class, 'update'])->name('clients.update');
});
