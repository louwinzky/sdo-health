<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/pending-approval', 'auth.pending-approval')->name('pending-approval');
});

require __DIR__.'/settings.php';
