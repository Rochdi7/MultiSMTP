<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [MailController::class, 'showForm'])->name('mail.form');
Route::post('/send-email', [MailController::class, 'send'])->name('send.email');
Route::get('/dashboard', [MailController::class, 'dashboard'])->name('mail.dashboard');

Route::prefix('smtp')->group(function () {
    Route::get('/', [MailController::class, 'index'])->name('smtp.index');
    Route::get('/create', [MailController::class, 'create'])->name('smtp.create');
    Route::post('/store', [MailController::class, 'store'])->name('smtp.store');
    Route::get('/{id}/edit', [MailController::class, 'edit'])->name('smtp.edit');
    Route::post('/{id}/update', [MailController::class, 'update'])->name('smtp.update');
    Route::delete('/{id}', [MailController::class, 'destroy'])->name('smtp.destroy');
});