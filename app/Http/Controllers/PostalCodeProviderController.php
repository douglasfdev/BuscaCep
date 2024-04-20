<?php

namespace App\Http\Controllers;

use App\Interfaces\PostalCodeProviderInterface;
use App\Services\PostalCodeProviderService as ServicesCepProviderService;

class PostalCodeProviderController extends Controller implements PostalCodeProviderInterface
{
    public function __construct(private readonly ServicesCepProviderService $cepProviderService)
    {
    }

    public function getAddresByPostalCode(string $cep): \Illuminate\Http\JsonResponse
    {
        return $this->cepProviderService->getAddresByPostalCode($cep);
    }
}
