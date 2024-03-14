<?php

use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return inertia('Home');
});

Route::middleware(['guest'])->group(function () {
	Route::get('/clients', [ClientController::class, 'index'])->name('client.index');
	Route::post('/clients', [ClientController::class, 'store'])->name('client.store');
	Route::get('/clients/{clientId}', [ClientController::class, 'show'])->name('client.show');
	Route::patch('/clients/{clientId}', [ClientController::class, 'update'])->name('client.update');
	Route::delete('/clients/delete/{clientId}', [ClientController::class, 'destroy'])->name('client.delete');
});