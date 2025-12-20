<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentFeedbackController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

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

// Classes
Route::get('/admin/class/edit/{id}', [ClassController::class, 'classedit'])->name('class.edit')->middleware(['auth', 'admin']);
Route::put('/admin/class/update/{id}', [ClassController::class, 'classupdate'])->name('class.update')->middleware(['auth', 'admin']);
Route::delete('/admin/class/delete/{id}', [ClassController::class, 'classdelete'])->name('class.delete')->middleware(['auth', 'admin']);

// Lessons
Route::get('/admin/lesson/create', [ClassController::class, 'lessoncreate'])->name('lesson.lessoncreate');
Route::post('/admin/lesson/store', [ClassController::class, 'lessonstore'])->name('lesson.lessonstore');
Route::get('/admin/lesson/edit/{id}', [ClassController::class, 'lessonedit'])->name('lesson.edit')->middleware(['auth', 'admin']);
Route::put('/admin/lesson/update/{id}', [ClassController::class, 'lessonupdate'])->name('lesson.update')->middleware(['auth', 'admin']);
Route::delete('/admin/lesson/delete/{id}', [ClassController::class, 'lessondelete'])->name('lesson.delete')->middleware(['auth', 'admin']);

// Class Lessons Page
Route::get('/admin/class/{id}/lessons', [ClassController::class, 'showClassLessons'])
        ->name('class.lessons');

// Packages
Route::get('/admin/package/create', [adminController::class, 'createPackage'])->name('package.create');
Route::post('/admin/package/store', [adminController::class, 'storePackage'])->name('package.store');
Route::get('/admin/package/edit/{id}', [adminController::class, 'packageedit'])->name('package.edit')->middleware(['auth', 'admin']);
Route::put('/admin/package/update/{id}', [adminController::class, 'packageupdate'])->name('package.update')->middleware(['auth', 'admin']);
Route::delete('/admin/package/delete/{id}', [adminController::class, 'packagedelete'])->name('package.delete')->middleware(['auth', 'admin']);
Route::get('/buyclass', [adminController::class, 'buyclass'])->name('buyclass');
Route::get('/cart', function () {return view('cart');})->name('cart.view');
Route::get('/checkout', [adminController::class, 'checkoutPage'])->name('checkout.page')->middleware('auth');
Route::post('/checkout/submit', [adminController::class, 'checkoutSubmit'])->name('checkout.submit')->middleware('auth');
Route::get('/paymentmanage', [adminController::class, 'paymentmanage'])->name('paymentmanage');
Route::put('/payment/approve/{id}', [adminController::class, 'paymentApprove'])->name('payment.approve');
Route::put('/payment/reject/{id}', [adminController::class, 'paymentReject'])->name('payment.reject');
Route::get('/usermanagement', [adminController::class, 'usermanagement'])->name('usermanagement');


// Serve storage files through Laravel to avoid direct webserver 403/permission issues.
// Usage in Blade: route('storage.file', ['encoded' => base64_encode($path)])
Route::get('/storage-file/{encoded}', function ($encoded) {
    $path = base64_decode($encoded);
    if (! $path) {
        abort(404);
    }

    $disk = Storage::disk('public');
    if (! $disk->exists($path)) {
        abort(404);
    }

    $fullPath = $disk->path($path);
    if (! is_readable($fullPath)) {
        abort(403);
    }

    $mime = mime_content_type($fullPath) ?: 'application/octet-stream';
    return response()->file($fullPath, ['Content-Type' => $mime]);
})->where('encoded', '.*')->name('storage.file');



