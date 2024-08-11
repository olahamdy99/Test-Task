<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Shipment routes
    Route::get('/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
    Route::post('/shipments', [ShipmentController::class, 'store'])->name('shipments.store');
    
    Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::get('/shipments/{id}', [ShipmentController::class, 'show'])->name('shipments.show');
    
    Route::get('/shipments/{id}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');
    Route::put('/shipments/{id}', [ShipmentController::class, 'update'])->name('shipments.update');
    
    Route::delete('/shipments/{id}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');
    


    // Journal routes
    Route::get('/journals/create', [JournalController::class, 'create'])->name('journals.create');
    Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');

    Route::get('/journals', [JournalController::class, 'index'])->name('journals.index');
    Route::get('/journals/{id}', [JournalController::class, 'show'])->name('journals.show');

    
    Route::get('/journals/{id}/edit', [JournalController::class, 'edit'])->name('journals.edit');
});





require __DIR__.'/auth.php';
