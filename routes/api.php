<?php

use Illuminate\Support\Facades\Route;

// AI Generation Endpoints (Used by internal jobs)
Route::prefix('ai')->group(function () {
    Route::post('/vision-extract', [AiController::class, 'extractPrompt']);
    Route::post('/generate-assets', [AiController::class, 'generateCampaignAssets']);
});

// No external webhooks needed; using polling architecture.