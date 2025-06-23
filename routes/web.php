<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');

// ✅ مسار العملات مع الاسم والصلاحية
Route::get('/currencies', [CurrencyController::class, 'index'])
    ->middleware(['auth', 'permission:view currencies'])
    ->name('currencies.index');

Route::middleware(['auth', 'permission:view suppliers'])->group(function () {
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
});

Route::middleware(['auth', 'permission:configure settings'])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
});

// ✅ إعدادات الحساب
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
     Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});


Route::resource('permissions', PermissionController::class)->middleware(['auth', 'role:admin']);
Route::get('/permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');
Route::resource('roles', RoleController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
});
Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});
Route::resource('users', \App\Http\Controllers\UserController::class);

Route::resource('agencies', \App\Http\Controllers\AgencyController::class)->middleware(['auth']);
Route::resource('agencies', AgencyController::class)->middleware(['auth']);

Route::resource('bookings', BookingController::class)->middleware(['auth']);

Route::resource('invoices', \App\Http\Controllers\InvoiceController::class)->middleware(['auth']);
Route::resource('invoices', App\Http\Controllers\InvoiceController::class);

require __DIR__ . '/auth.php';
