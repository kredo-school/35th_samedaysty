<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

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
});

// to make sure if the design is working
Route::get('/show-plan', [PlanController::class, 'view'])->name('plan.view');

// AlpineJS カレンダーコンポーネントのテストページ
Route::get('/calendar-test', function () {
    return view('calendar-test');
})->name('calendar.test');

require __DIR__ . '/auth.php';
