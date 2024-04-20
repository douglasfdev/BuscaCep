<?php

use App\Http\Controllers\PostalCodeProviderController;
use Illuminate\Support\Facades\Route;

Route::prefix('cep')->controller(PostalCodeProviderController::class)->group(function () {
    Route::get('/{cep}', 'getAddresByPostalCode');
});
