<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LabelController;
use App\Http\Controllers\Backend\ArtistController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\ProductionsController;

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



        //ArtistController Routes
        Route::resource('artists', ArtistController::class);
        Route::get('artists/status/{id}', [ArtistController::class, 'changeStatus'])->name('artists.status');

        //LabelController Routes
        Route::resource('labels', LabelController::class);
        Route::get('labels/status/{id}', [LabelController::class, 'changeStatus'])->name('labels.status');

        //ProductionsController Routes
        Route::resource('productions', ProductionsController::class);
        Route::get('productions/status/{id}', [ProductionsController::class, 'changeStatus'])->name('productions.status');


    });

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
