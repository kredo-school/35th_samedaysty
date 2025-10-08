<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\TravelStyleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ParticipantChatController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\NotificationController;
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
    Route::post('/profile/toggle-status', [ProfileController::class, 'toggleStatus'])
        ->name('profile.toggleStatus')->middleware('auth');
    Route::patch('/profile/update-recommended-form', [ProfileController::class, 'updateGadget'])
        ->name('profile.updateGadget');
    Route::delete('/profile/gadget/{gadget}', [ProfileController::class, 'destroyGadget'])
        ->name('profile.gadget.destroy');
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

// comments
Route::middleware(['auth'])->group(function () {
    Route::post('/comment/{id}/store', [CommentController::class, 'store'])->name('comment.store');
});

// participant chats
Route::middleware(['auth'])->group(function () {
    Route::post('/participant_chat/{id}/store', [ParticipantChatController::class, 'store'])->name('participant_chat.store');
});

// plans
Route::middleware(['auth'])->prefix('plan')->name('plan.')->group(function () {
    Route::get('/joined/my', [PlanController::class, 'joinedPlans'])->name('joined.my');
    Route::get('/my/all', [PlanController::class, 'myPlans'])->name('my.all');
    Route::get('/{id}/detail', [PlanController::class, 'detail'])->name('show');
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

// participations
Route::middleware(['auth'])->group(function () {
    Route::post('/participations', [ParticipationController::class, 'store'])->name('participations.store');
    Route::patch('/participations/{participation}/update/', [ParticipationController::class, 'update'])->name('participations.update');
    Route::delete('/participations/{participation}', [ParticipationController::class, 'destroy'])
    ->name('participations.destroy');
});



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
})->name('support');

// API routes for countries
Route::get('/api/countries', [App\Http\Controllers\Api\CountryController::class, 'index'])->name('api.countries.index');
Route::get('/api/countries/{name}', [App\Http\Controllers\Api\CountryController::class, 'show'])->name('api.countries.show');
// API route for plans
Route::get('/travel-plans', [PlanController::class, 'apiIndex']);

//follows
Route::middleware(['auth'])->group(function () {
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
    Route::get('/users/{user}/following/json', [FollowController::class, 'followingJson'])
        ->name('users.following.json');
    Route::get('/users/{user}/followers/json', [FollowController::class, 'followersJson'])
        ->name('users.followers.json');
    Route::post('/follow/approve/{id}', [FollowController::class, 'approveRequest'])->name('follow.approve');
    Route::post('/follow/reject/{id}', [FollowController::class, 'rejectRequest'])->name('follow.reject');
    Route::post('/follow/{user}/request', [FollowController::class, 'followRequest'])->name('follow.request');

    // Notification System
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/unread', [NotificationController::class, 'unread'])->name('unread');
        Route::get('/unread-count', [NotificationController::class, 'unreadCount'])->name('unread-count');
        Route::patch('/{id}/read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
        Route::patch('/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
    });
});


require __DIR__ . '/auth.php';
