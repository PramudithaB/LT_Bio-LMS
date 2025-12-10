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
Route::get('/classview/{id}', [adminController::class, 'classview'])->name('classview');
Route::get('/classvideo/{id}', [adminController::class, 'classvideo'])->name('classvideo');
Route::get('/classmanage', [ClassController::class, 'classmanage'])->name('classmanage');
Route::post('/classstore', [ClassController::class, 'classstore'])->name('classstore');
Route::get('/dashboard', [ClassController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/feedbackstore', [StudentFeedbackController::class, 'feedbackstore'])->name('feedbackstore');
// Route::delete('/feedback/delete/{id}', [StudentFeedbackController::class, 'destroy'])->name('feedback.delete');
// Route::get('/feedbackcreate', [StudentFeedbackController::class, 'feedbackcreate'])->name('feedbackcreate');
Route::get('/feedbackmanage', [StudentFeedbackController::class, 'feedbackmanage'])->name('feedbackmanage');
Route::put('/feedback/approve/{id}', [StudentFeedbackController::class, 'feedbackapprove'])->name('feedbackapprove');

Route::delete('/feedback/delete/{id}', [StudentFeedbackController::class, 'feedbackdelete'])->name('feedbackdelete');

// Lessons
Route::get('/admin/lesson/create', [ClassController::class, 'lessoncreate'])->name('lesson.lessoncreate');
Route::post('/admin/lesson/store', [ClassController::class, 'lessonstore'])->name('lesson.lessonstore');

// Class Lessons Page
Route::get('/admin/class/{id}/lessons', [ClassController::class, 'showClassLessons'])
        ->name('class.lessons');
Route::get('/admin/package/create', [adminController::class, 'createPackage'])->name('package.create');
Route::post('/admin/package/store', [adminController::class, 'storePackage'])->name('package.store');
