<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;

Route::view('/', 'welcome');

// Route::as('front.')->group(function () {
//     Route::get('/', [FrontendController::class, 'home'])->name('index');



// });

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');




    Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('elements', [DashboardController::class, 'elements'])->name('dashboard.elements');
        // General
        Route::post('editor/image/upload', [DashboardController::class, 'imageUpload'])->name('editor.file.upload');


    });

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
