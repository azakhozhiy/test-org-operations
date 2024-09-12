<?php

use App\Http\Controllers\OperationController;
use App\Http\Controllers\OrgController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->name('v1.')->group(function (): void {

    Route::prefix('/operations')->name('operations.')->group(function (): void {
        Route::get('/', [OperationController::class, 'getList'])->name('list');
    });

    Route::prefix('/organisations')->name('organisations.')->group(function (): void {
        Route::get('/', [OrgController::class, 'getList'])->name('list');

        Route::get('/stats', [OrgController::class, 'getStats'])->name('list');
    });
});
