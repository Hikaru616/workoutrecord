<?php

use App\Http\Controllers\BenchController;
use App\Http\Controllers\BigthreeController;
use App\Http\Controllers\DeadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SquatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

#Record
Route::get('/', [RecordController::class, 'index'])->name('home');
Route::get('/record', [RecordController::class, 'index'])->name('record.index');
Route::get('/record/update', [RecordController::class, 'update'])->name('record.update');
Route::get('/record/records', [RecordController::class, 'records'])->name('record.records');
Route::post('/record/store', [RecordController::class, 'store'])->name('record.store');
Route::patch('/record/{id}/updateDetail', [RecordController::class, 'updateDetail'])->name('record.updateDetail');
Route::delete('/record/{id}/destroy', [RecordController::class, 'destroy'])->name('record.destroy');

#BigThree
Route::get('/bigthree', [BigthreeController::class, 'index'])->name('bigthree.index');

#Bench
Route::post('/bench/store', [BenchController::class, 'store'])->name('bench.store');

#Dead
Route::post('/dead/store', [DeadController::class, 'store'])->name('dead.store');

#Squat
Route::post('/squat/store', [SquatController::class, 'store'])->name('squat.store');

});
