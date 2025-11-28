<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentFeedbackController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::get('/admindashboard', [adminController::class, 'admindashboard'])->name('admindashboard')->middleware(['auth', 'admin']);
Route::get('/classview', [adminController::class, 'classview'])->name('classview');
Route::get('/classvideo', [adminController::class, 'classvideo'])->name('classvideo');
Route::get('/classmanage', [ClassController::class, 'classmanage'])->name('classmanage');
Route::post('/classstore', [ClassController::class, 'classstore'])->name('classstore');
Route::get('/dashboard', [ClassController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('classstore');


Route::post('/feedbackstore', [StudentFeedbackController::class, 'feedbackstore'])->name('feedbackstore');
// Route::delete('/feedback/delete/{id}', [StudentFeedbackController::class, 'destroy'])->name('feedback.delete');
// Route::get('/feedbackcreate', [StudentFeedbackController::class, 'feedbackcreate'])->name('feedbackcreate');
Route::get('/feedbackmanage', [StudentFeedbackController::class, 'feedbackmanage'])->name('feedbackmanage');
