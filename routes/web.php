<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes - SMARTEDU-NUTRICHEM
|--------------------------------------------------------------------------
*/

// Public Landing Page & Features
Route::get('/', [HomeController::class, 'index'])->name('home');

// Direct Storage File Server Fallback for Hosting/cPanel without working symlink
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath);
})->where('path', '.*');

Route::get('/storage-link', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'Storage link berhasil dibuat!';
    } catch (\Exception $e) {
        return 'Gagal membuat storage link: ' . $e->getMessage();
    }
});
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');
Route::post('/testimonial', [HomeController::class, 'storeTestimonial'])->name('testimonial.store');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::post('/game/log', [QuizController::class, 'logGame'])->name('game.log');
Route::get('/modul/{id}/download', [ModulController::class, 'download'])->name('modul.download');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin CMS Routes (Protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Site Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Moduls CMS
    Route::get('/modul', [AdminController::class, 'moduls'])->name('moduls');
    Route::post('/modul', [AdminController::class, 'storeModul'])->name('moduls.store');
    Route::put('/modul/{id}', [AdminController::class, 'updateModul'])->name('moduls.update');
    Route::delete('/modul/{id}', [AdminController::class, 'deleteModul'])->name('moduls.delete');

    // Gallery CMS
    Route::get('/gallery', [AdminController::class, 'galleries'])->name('galleries');
    Route::post('/gallery', [AdminController::class, 'storeGallery'])->name('galleries.store');
    Route::put('/gallery/{id}', [AdminController::class, 'updateGallery'])->name('galleries.update');
    Route::delete('/gallery/{id}', [AdminController::class, 'deleteGallery'])->name('galleries.delete');

    // Teams CMS
    Route::get('/team', [AdminController::class, 'teams'])->name('teams');
    Route::post('/team', [AdminController::class, 'storeTeam'])->name('teams.store');
    Route::put('/team/{id}', [AdminController::class, 'updateTeam'])->name('teams.update');
    Route::delete('/team/{id}', [AdminController::class, 'deleteTeam'])->name('teams.delete');

    // Testimonials CMS
    Route::get('/testimonial', [AdminController::class, 'testimonials'])->name('testimonials');
    Route::post('/testimonial', [AdminController::class, 'storeTestimonial'])->name('testimonials.store');
    Route::put('/testimonial/{id}', [AdminController::class, 'updateTestimonial'])->name('testimonials.update');
    Route::delete('/testimonial/{id}', [AdminController::class, 'deleteTestimonial'])->name('testimonials.delete');

    // Messages Inbox
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
    Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('messages.delete');

    // Quizzes CMS
    Route::get('/quiz', [AdminController::class, 'quizzes'])->name('quizzes');
    Route::post('/quiz', [AdminController::class, 'storeQuiz'])->name('quizzes.store');
    Route::put('/quiz/{id}', [AdminController::class, 'updateQuiz'])->name('quizzes.update');
    Route::delete('/quiz/{id}', [AdminController::class, 'deleteQuiz'])->name('quizzes.delete');
    Route::delete('/quiz-submissions/{id}', [AdminController::class, 'deleteQuizSubmission'])->name('quizzes.deleteSubmission');

    // Plate Items CMS (Susun Piring Sehat)
    Route::get('/plate-items', [AdminController::class, 'plateItems'])->name('plate_items');
    Route::post('/plate-items', [AdminController::class, 'storePlateItem'])->name('plate_items.store');
    Route::put('/plate-items/{id}', [AdminController::class, 'updatePlateItem'])->name('plate_items.update');
    Route::delete('/plate-items/{id}', [AdminController::class, 'deletePlateItem'])->name('plate_items.delete');

    // Nutrition Guesses CMS (Tebak Nutrisi)
    Route::get('/guesses', [AdminController::class, 'guesses'])->name('guesses');
    Route::post('/guesses', [AdminController::class, 'storeGuess'])->name('guesses.store');
    Route::put('/guesses/{id}', [AdminController::class, 'updateGuess'])->name('guesses.update');
    Route::delete('/guesses/{id}', [AdminController::class, 'deleteGuess'])->name('guesses.delete');
});
