<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\QualityControlController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\SanitationController;
use App\Http\Controllers\ResearchDevelopmentController;
use App\Http\Controllers\SupplyChainController;
use App\Http\Controllers\AnalyticsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Production Routes
    Route::resource('production', ProductionController::class);

    // Quality Control Routes
    Route::resource('quality-control', QualityControlController::class);

    // Maintenance Routes
    Route::resource('maintenance', MaintenanceController::class);

    // Sanitation Routes
    Route::resource('sanitation', SanitationController::class);

    // Research & Development Routes
    Route::resource('research-development', ResearchDevelopmentController::class);

    // Supply Chain & Logistics Routes
    Route::resource('supply-chain', SupplyChainController::class);

    // Analytics & Reporting Routes
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.dashboard');
    Route::get('/analytics/reports', [AnalyticsController::class, 'reports'])->name('analytics.reports');
    Route::get('/analytics/export', [AnalyticsController::class, 'export'])->name('analytics.export');
});
