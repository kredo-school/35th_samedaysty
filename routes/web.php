<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\TravelStyleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ReactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/{id?}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/update-recommended-form', [ProfileController::class, 'updateGadget'])
    ->name('profile.updateGadget');
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
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

Route::middleware(['auth'])->group(function () {
    Route::post('/comment/{id}/store', [CommentController::class,'store'])->name('comment.store');
});


// plans
Route::middleware(['auth'])->prefix('plan')->name('plan.')->group(function () {
    Route::get('/{id}/detail', [PlanController::class, 'detail'])->name('detail');
    Route::get('/search', [PlanController::class, 'search'])->name('search');
    Route::get('/create', [PlanController::class, 'create'])->name('create');
    Route::post('/store', [PlanController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PlanController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [PlanController::class, 'update'])->name('update');
    Route::delete('/{id}/delete', [PlanController::class, 'destroy'])->name('delete');

});

// reactions
Route::middleware(['auth'])->group(function () {
    Route::post('/{id}/store', [ReactionController::class, 'store'])->name('reaction.store');
});


// API route for plans
Route::get('/travel-plans', [PlanController::class, 'apiIndex']);


// Chat routes
// Chat System
Route::middleware(['auth'])->prefix('chat')->name('chat.')->group(function () {
    // Chat Dashboard
    Route::get('/', [ChatController::class, 'index'])->name('index');

    // Conversation Management
    Route::get('/conversations', [ChatController::class, 'getConversations'])->name('conversations');
    Route::get('/conversations/{id}', [ChatController::class, 'show'])->name('conversation');
    Route::get('/conversations/{id}/messages', [ChatController::class, 'getMessages'])->name('messages');

    // Message Actions
    Route::post('/start-conversation', [ChatController::class, 'startConversation'])->name('start-conversation');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');
});

// support page
Route::get('/support', function () {
    return view('support');
});

// API routes for countries
Route::get('/api/countries', [App\Http\Controllers\Api\CountryController::class, 'index'])->name('api.countries.index');
Route::get('/api/countries/{name}', [App\Http\Controllers\Api\CountryController::class, 'show'])->name('api.countries.show');
// API route for plans
Route::get('/travel-plans', [PlanController::class, 'apiIndex']);

//follows
Route::middleware(['auth'])->group(function () {
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
});


require __DIR__ . '/auth.php';
