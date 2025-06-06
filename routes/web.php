<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\DailyPrintController;
use App\Http\Controllers\MonthlyPrintController;
use App\Http\Controllers\BulkPrintController;
use App\Http\Controllers\PresenceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Users Routes
Route::prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/', [UsersController::class, 'store'])->name('users.store');
    Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('/{id}/presences', [UsersController::class, 'presences'])->name('users.presences');
});

// Events Routes
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::get('/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/', [EventController::class, 'store'])->name('events.store');
    Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/{event}/presences', [EventController::class, 'presences'])->name('events.presences');
});

// Generate ID Routes
Route::prefix('generate')->group(function () {
    Route::get('/id', [GenerateController::class, 'show'])->name('generate.id.show');
    Route::post('/id', [GenerateController::class, 'process'])->name('generate.id.process');
    Route::get('/barcode/download/{member_id}', [GenerateController::class, 'downloadBarcode'])->name('barcode.download');
});

// Presence Routes
Route::prefix('scan')->group(function () {
    Route::get('/', [ScanController::class, 'showScanner'])->name('scan.show');
    Route::post('/handle', [ScanController::class, 'handleScan'])->name('scan.handle');
    Route::get('/success', [ScanController::class, 'scanSuccess'])->name('scan.success');
    Route::get('/error', [ScanController::class, 'scanError'])->name('scan.error');
});

// Daily Print Routes
Route::post('/scan', [ScanController::class, 'handleScanAjax']);


// Bulk Print Routes
Route::prefix('print')->group(function () {
    Route::get('/all-id', [BulkPrintController::class, 'printAll'])->name('print.all.id');
});
