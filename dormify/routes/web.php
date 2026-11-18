<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // REPORT
    Route::get('/reports', [ReportController::class, 'index']);

    Route::get('/reports/create', [ReportController::class, 'create']);

    Route::post('/reports/store', [ReportController::class, 'store']);

    Route::get('/reports/{report}/edit', [ReportController::class, 'edit']);

    Route::put('/reports/{report}', [ReportController::class, 'update']);

    Route::delete('/reports/{report}', [ReportController::class, 'destroy']);

    Route::post('/reports/{report}/update-status', [ReportController::class, 'updateStatus']);

    Route::get('/reports/{report}', [ReportController::class, 'show']);

    // DORMITORIES
    Route::get('/dormitories', function () {
        return view('dormitories.index');
    });

    // CATEGORIES
    Route::get('/categories', function () {
        return view('categories.index');
    });

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';