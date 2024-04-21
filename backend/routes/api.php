<?php

use App\Http\Controllers\PostalCodeProviderController;
use App\Http\Middleware\AddCustomCorsHeaders;
use Illuminate\Support\Facades\Route;

Route::middleware([AddCustomCorsHeaders::class])->prefix('cep')->controller(PostalCodeProviderController::class)->group(function () {
    Route::get('/{cep}', 'getAddresByPostalCode');
});
