<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\JournalController;

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
    return view('welcome');
});

Route::resource('shipments', ShipmentController::class);
Route::resource('journals', JournalController::class);



// Route to display the edit form (GET request)
Route::get('/shipments/{id}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');

// Route to handle the form submission for updating a shipment (PUT request)
Route::put('/shipments/{id}', [ShipmentController::class, 'update'])->name('shipments.update');
