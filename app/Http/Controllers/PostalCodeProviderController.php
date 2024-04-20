<?php

namespace App\Http\Controllers;

use App\Interfaces\PostalCodeControllerInterface;
use App\Services\PostalCodeProviderService as ServicesCepProviderService;

class PostalCodeProviderController extends Controller implements PostalCodeControllerInterface
{
    public function __construct(private readonly ServicesCepProviderService $cepProviderService)
    {
    }

    public function getAddresByPostalCode(int $cep): \Illuminate\Http\JsonResponse
    {
        return $this->cepProviderService->getAddresByPostalCode($cep);
    }
}
