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

