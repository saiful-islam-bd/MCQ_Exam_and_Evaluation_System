<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Admin\McqController;
use App\Http\Controllers\Student\ExamController;

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


// google authentication
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);


// admin manage mcqw route
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('mcqs', McqController::class)->except(['show']);
    
    Route::get('/mcqs/bulk-create', [McqController::class, 'bulkCreate'])->name('mcqs.bulk.create');
    Route::post('/mcqs/bulk-store', [McqController::class, 'bulkStore'])->name('mcqs.bulk.store');
});


// student exam route
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/exam', [ExamController::class, 'index'])->name('exam.index');
    Route::post('/exam/submit', [ExamController::class, 'submit'])->name('exam.submit');
    Route::get('/exam/result', [ExamController::class, 'result'])->name('exam.result');
});



