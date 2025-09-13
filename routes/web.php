<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\Admin\TravelStyleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('travel-styles', TravelStyleController::class);
    Route::resource('users', UserController::class);
    Route::post('users/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
});


// plans
Route::get('/plan/detail', [PlanController::class, 'detail'])->name('plan.detail');
Route::get('/plan/search', [PlanController::class, 'search'])->name('plan.search');
Route::get('/create-plan', [PlanController::class, 'create'])->name('plan.create');
Route::post('/create-plan', [PlanController::class, 'store'])->name('plan.store');

// API route for plans
Route::get('/travel-plans', [PlanController::class, 'apiIndex']);


// Chat routes
Route::middleware(['auth'])->prefix('chat')->name('chat.')->group(function () {
    Route::get('/', [App\Http\Controllers\ChatController::class, 'index'])->name('index');
    Route::get('/conversations/{conversation}', [App\Http\Controllers\ChatController::class, 'show'])->name('conversation');
    Route::post('/start-conversation', [App\Http\Controllers\ChatController::class, 'startConversation'])->name('start-conversation');
    Route::post('/send-message', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('send-message');
    Route::get('/conversations/{conversation}/messages', [App\Http\Controllers\ChatController::class, 'getMessages'])->name('messages');

    Route::get('/conversations', [App\Http\Controllers\ChatController::class, 'getConversations'])->name('conversations');
});

// support page
Route::get('/support', function () {return view('support');});

// API routes for countries
Route::get('/api/countries', [App\Http\Controllers\Api\CountryController::class, 'index'])->name('api.countries.index');
Route::get('/api/countries/{name}', [App\Http\Controllers\Api\CountryController::class, 'show'])->name('api.countries.show');

Route::get('/calendar-test', function () {
    return view('calendar-test');
})->name('calendar.test');

// Flag test page
Route::get('/flag-test', function () {
    return view('flag-test');
})->name('flag.test');

require __DIR__ . '/auth.php';
