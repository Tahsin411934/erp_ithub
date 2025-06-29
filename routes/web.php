<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('courses', CourseController::class);
    Route::resource('sessions', SessionController::class);
    Route::get('/payments/session', [SessionController::class, 'paymentSession']);
    Route::get('/payments/due/student/{batch}', [PaymentController::class, 'dueStudents'])->name('due.students');
    Route::resource('students', StudentController::class);
    Route::get('/payment-history/{student}', [PaymentController::class, 'paymentHistory'])->name('payment.history');
    Route::post('/duepayment/save/{student_id}', [PaymentController::class, 'store'])->name('duepayment.store');
});

require __DIR__.'/auth.php';
