<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('campaigns.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/analytics', [ProfileController::class, 'analytics'])->name('profile.analytics');

    // Campaign Routes
    Route::prefix('campaigns')->group(function () {
        Route::get('/library', [\App\Http\Controllers\CampaignController::class, 'library'])->name('library');
        Route::get('/', [\App\Http\Controllers\CampaignController::class, 'index'])->name('campaigns.index');
        Route::get('/create', [\App\Http\Controllers\CampaignController::class, 'create'])->name('campaigns.create');
        Route::post('/store', [\App\Http\Controllers\CampaignController::class, 'store'])->name('campaigns.store');
        Route::get('/{id}', [\App\Http\Controllers\CampaignController::class, 'show'])->name('campaigns.show');
        Route::post('/{id}/update-text', [\App\Http\Controllers\CampaignController::class, 'updateText'])->name('campaigns.update_text');
        Route::post('/{id}/approve-generation', [\App\Http\Controllers\CampaignController::class, 'approveGeneration'])->name('campaigns.approve_generation');
    });

    // Media & Feedback Loop
    Route::post('/media/{id}/feedback', [\App\Http\Controllers\MediaController::class, 'submitFeedback'])->name('media.feedback');

    // Chatbot Routes
    Route::get('/chatbot', [\App\Http\Controllers\AiController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/message', [\App\Http\Controllers\AiController::class, 'message'])->name('chatbot.message');
    Route::get('/chatbot/session/{id}', [\App\Http\Controllers\AiController::class, 'loadSession'])->name('chatbot.session');
});

// Admin Panel Routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', \App\Http\Controllers\AdminUserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

require __DIR__.'/auth.php';
