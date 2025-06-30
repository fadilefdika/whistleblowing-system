<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
})->name(('landingpage'));

Route::get('/whistleblowing/form', [ReportController::class, 'form'])->name('whistleblowing.form');
Route::get('/whistleblowing/track', [ReportController::class, 'track'])->name('whistleblowing.track');
Route::get('/whistleblowing/trackresult', [ReportController::class, 'trackresult'])->name('whistleblowing.trackresult');
Route::post('/whistleblowing/track', [ReportController::class, 'store'])->name('whistleblowing.submit');
Route::get('/whistleblowing/success/{report_number}', [ReportController::class, 'success'])->name('whistleblowing.success');

// routes/web.php
Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
Route::get('/admin/reports/data', [ReportController::class, 'data'])->name('admin.reports.data');
Route::get('/admin/reports/{id}', [ReportController::class, 'show'])->name('admin.reports.show');


