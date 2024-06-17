<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\TechnologyTagController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin', [RegisterController::class, 'showLoginForm'])->name('admin');
Route::post('/admin', [RegisterController::class, 'admin']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');;
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


Route::get('/referrer-report', [RegisterController::class, 'report'])->name('referrer.report');


Route::resource('technology-tags', TechnologyTagController::class); //admin crud for technology

Route::get('/technology-tag-report', [RegisterController::class, 'technologyReport'])->name('technology-tag.report'); //for admin



Route::post('/select-technology', [RegisterController::class, 'chooseTechnologies'])->name('select.technology');


Route::get('/show', [RegisterController::class, 'sh']);