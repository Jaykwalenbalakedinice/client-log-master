<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/clientLogs', [ClientController::class, 'clientLogs'])->name('client.clientLogs');
Route::get('/clientLogs/applicationForm', [ClientController::class, 'applicationForm'])->name('client.applicationForm');
Route::post('/clientLogs/applicationForm', [ClientController::class, 'store'])->name('client.store');
Route::delete('/clientLogs/{client}/destroy', [ClientController::class, 'destroy'])->name('client.destroy');
Route::put('/clientLogs/logout/{client}', [ClientController::class, 'logout'])->name('client.logout');

