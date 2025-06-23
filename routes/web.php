<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});

// ✅ تعديل صلاحية دخول لوحة التحكم
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ✅ إعدادات الحساب
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
});

// ✅ مسارات العملات
Route::get('/currencies', [CurrencyController::class, 'index'])
    ->middleware(['auth', 'permission:view currencies'])
    ->name('currencies.index');

// ✅ المورّدين
Route::middleware(['auth', 'permission:view suppliers'])->group(function () {
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
});

// ✅ الإعدادات العامة
Route::middleware(['auth', 'permission:configure settings'])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
});

// ✅ إدارة الصلاحيات
Route::resource('permissions', PermissionController::class)->middleware(['auth']);
Route::get('/permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');

// ✅ إدارة الأدوار
Route::resource('roles', RoleController::class)->middleware(['auth']);
Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');

// ✅ إدارة المستخدمين
Route::resource('users', UserController::class)->middleware(['auth']);

// ✅ إدارة الوكالات
Route::resource('agencies', AgencyController::class)->middleware(['auth']);

// ✅ إدارة الحجوزات
Route::resource('bookings', BookingController::class)->middleware(['auth']);

// ✅ إدارة الفواتير
Route::resource('invoices', InvoiceController::class)->middleware(['auth']);

require __DIR__ . '/auth.php';
