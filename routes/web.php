<?php

use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('landingpage');
})->name(('landingpage'));

Route::get('/whistleblowing/form', [ReportController::class, 'form'])->name('whistleblowing.form');
Route::get('/whistleblowing/track', [ReportController::class, 'track'])->name('whistleblowing.track');
Route::get('/whistleblowing/trackresult', [ReportController::class, 'trackresult'])->name('whistleblowing.trackresult');
Route::post('/whistleblowing/track', [ReportController::class, 'store'])->name('whistleblowing.submit');
Route::get('/whistleblowing/success/{report_number}', [ReportController::class, 'success'])->name('whistleblowing.success');


Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin routes (dengan middleware admin.auth)
Route::middleware(AdminAuth::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/data', [ReportController::class, 'data'])->name('reports.data');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
    Route::put('/reports/{id}/close', [ReportController::class, 'close'])->name('reports.close');


    
});

