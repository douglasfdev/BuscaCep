<?php

namespace App\Http\Controllers;

use App\Interfaces\IPostalCode;
use App\Services\PostalCodeProviderService as ServicesCepProviderService;

class PostalCodeProviderController extends Controller implements IPostalCode
{
    public function __construct(private readonly ServicesCepProviderService $cepProviderService)
    {
    }

    public function getAddresByPostalCode(int $cep)
    {
        return $this->cepProviderService->getAddresByPostalCode($cep);
    }
}
