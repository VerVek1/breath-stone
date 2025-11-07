<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoneCatalogController;
use App\Http\Controllers\ClientController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home');
Route::view('/contacts', 'contacts');
Route::get('/catalog', [StoneCatalogController::class, 'index'])->name('catalog.stones');
Route::get('/catalog/{stone}', [StoneCatalogController::class, 'show'])->name('catalog.stones.show');

// Политика конфиденциальности и пользовательское соглашение
Route::view('/privacy-policy', 'privacy-policy')->name('privacy.policy');
Route::view('/user-agreement', 'user-agreement')->name('user.agreement');
Route::view('/cookie-policy', 'cookie-policy')->name('cookie.policy');

// Форма заявок (защита ограничением частоты)
Route::post('/submit-application', [ClientController::class, 'store'])
    ->middleware('throttle:applications')
    ->name('application.submit');

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\StoneController;
use App\Http\Controllers\Admin\ApplicationsController;

// Admin auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Protected admin
Route::get('/admin', [AdminController::class, 'index'])->middleware('admin.password')->name('admin.index');

Route::middleware('admin.password')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('materials', MaterialController::class)->except(['show']);
    Route::resource('manufacturers', ManufacturerController::class)->except(['show']);
    Route::resource('stones', StoneController::class)->except(['show']);
    Route::resource('applications', ApplicationsController::class)->only(['index', 'show', 'destroy']);
    Route::patch('applications/{client}/status', [ApplicationsController::class, 'updateStatus'])->name('applications.status');
});


