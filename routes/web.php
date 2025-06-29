<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
  use App\Http\Controllers\StationaryCategoryController;
  use App\Http\Controllers\ItemController;
  use App\Http\Controllers\InventoryController;
  use App\Http\Controllers\SaleController;

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
    Route::get('/duepayment/save/{student_id}', [PaymentController::class, 'printSlip'])->name('duepayment.get');
    Route::resource('stationary-categories', StationaryCategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('inventory', InventoryController::class);
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::get('/sales/products-by-category/{categoryId}', [SaleController::class, 'getProductsByCategory']);
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales/{sale}/receipt', [SaleController::class, 'receipt'])
    ->name('sales.receipt');
});

require __DIR__.'/auth.php';
