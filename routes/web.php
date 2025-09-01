<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTimeSheetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::resource('users', UserController::class);

    Route::get('timesheet/{id}/time-sheet', [UserTimeSheetController::class, 'timeSheet'])->name('users.time_sheet');
    Route::get('timesheet/register-clock-in', [UserTimeSheetController::class, 'registerClockIn'])->name('users.register_clock_in');
    Route::get('timesheet/report', [UserTimeSheetController::class, 'report'])->name('timesheet.report');
});

require __DIR__.'/auth.php';
