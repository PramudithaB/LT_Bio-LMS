<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentFeedbackController;

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

require __DIR__ . '/auth.php';
Route::get('/admindashboard', [adminController::class, 'admindashboard'])->middleware(['auth', 'admin']);
Route::get('/classview', [adminController::class, 'classview'])->name('classview');
Route::get('/classvideo', [adminController::class, 'classvideo'])->name('classvideo');
Route::get('/classmanage', [ClassController::class, 'classmanage'])->name('classmanage');

Route::post('/feedbackstore', [StudentFeedbackController::class, 'feedbackstore'])->name('feedbackstore');
// Route::delete('/feedback/delete/{id}', [StudentFeedbackController::class, 'destroy'])->name('feedback.delete');
// Route::get('/feedbackcreate', [StudentFeedbackController::class, 'feedbackcreate'])->name('feedbackcreate');
Route::get('/feedbackmanage', [StudentFeedbackController::class, 'feedbackmanage'])->name('feedbackmanage');
Route::put('/feedback/approve/{id}', [StudentFeedbackController::class, 'feedbackapprove'])->name('feedbackapprove');

Route::delete('/feedback/delete/{id}', [StudentFeedbackController::class, 'feedbackdelete'])->name('feedbackdelete');
