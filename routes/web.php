<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [MailController::class, 'showForm'])->name('mail.form');
Route::post('/send-email', [MailController::class, 'send'])->name('send.email');
