<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrainingCenterController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Localized public routes
|--------------------------------------------------------------------------
| Every public URL is prefixed with the active locale (e.g. /en, /kn).
| The middleware handles locale detection, session persistence and
| redirecting the bare "/" to the visitor's preferred language.
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::get('/', HomeController::class)->name('home');

    Route::get('/'.__('routes.centers'), [TrainingCenterController::class, 'index'])->name('centers.index');

    Route::get('/'.__('routes.gallery'), [GalleryController::class, 'index'])->name('gallery');

    Route::get('/'.__('routes.events'), [EventController::class, 'index'])->name('events.index');
    Route::get('/'.__('routes.events').'/{slug}', [EventController::class, 'show'])->name('events.show');

    Route::get('/'.__('routes.contact'), [ContactController::class, 'show'])->name('contact');
    Route::post('/'.__('routes.contact'), [ContactController::class, 'store'])->name('contact.store');
});
