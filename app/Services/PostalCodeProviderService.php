<?php

namespace App\Services;

use App\DTO\CepResponseDTO;
use App\Enums\HttpStatusCode;
use App\Interfaces\PostalCodeProviderInterface;
use Illuminate\Support\Facades\Http;

class PostalCodeProviderService implements PostalCodeProviderInterface
{
  public function __construct(private readonly Http $http)
  {
  }

  public function getAddresByPostalCode(string $cep): \Illuminate\Http\JsonResponse
  {
    $request = $this->http::withOptions([
      'verify' => false
    ])
      ->withUrlParameters([
        'endpoint' => env('ENDPOINT'),
      ])
      ->withQueryParameters([
        'apiKey' => env('APIKEY'),
        'q' => $cep,
      ])
      ->get("{+endpoint}/geocode");

    if (!$request->successful()) {
      return response()->json(
        [
          'error' => 'Erro inesperado aconteceu, contate o suporte'
        ],
        HttpStatusCode::BadRequest->value
      );
    }

    if (empty($request['items'])) {
      return response()->json(
        [
          'error' => 'CEP não encontrado'
        ],
        HttpStatusCode::BadRequest->value
      );
    }

    $data = $this->buildResponseData($request['items'][0]);

    return response()->json([
      'data' => $data
    ], HttpStatusCode::OK->value);
  }

  private function buildResponseData(array $data)
  {
    return new CepResponseDTO($data);
  }
}
