<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientNoteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/ss', [UserController::class, 'ss']);

// Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect'])->group(
Route::prefix(LaravelLocalization::setLocale())->middleware(['localeCookieRedirect', 'localizationRedirect'])->group(
	function () {

		Auth::routes([
			'register' => false,
		]);

		Route::get('/', [InvoiceController::class, 'index'])->name('home');
		Route::post('/invoice', [InvoiceController::class, 'store'])->name('invoice.store');
		Route::get('/invoice/search/{limit}', [InvoiceController::class, 'index'])->name('invoice.index');
		Route::get('/invoice/new/{patient}', [InvoiceController::class, 'create'])->name('invoice.new');
		Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
		Route::get('/invoice/{invoice}/print', [InvoiceController::class, 'print'])->name('invoice.print');

		Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');
		Route::post('/patient', [PatientController::class, 'store'])->name('patient.store');
		Route::get('/patient/new', [PatientController::class, 'show'])->name('patient.new');
		Route::get('/patient/fetch/{patient}', [PatientController::class, 'fetch'])->name('patient.fetch');
		Route::post('/patient/notes', [PatientNoteController::class, 'index'])->name('patient.notes');
		Route::post('/patient/notes/store', [PatientNoteController::class, 'store'])->name('patient.notes.store');
		Route::post('/patient/autocomplete', [PatientController::class, 'autocomplete'])->name('patient.autocomplete');
		Route::get('/patient/{patient?}', [PatientController::class, 'show'])->name('patient.show');

		Route::get('/profile', [UserController::class, 'edit'])->name('profile');
		Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

		Route::get('/settings', [SettingsController::class, 'edit'])->name('settings');
		Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

		Route::get('/report', [ReportController::class, 'index'])->name('report');
	}
);
