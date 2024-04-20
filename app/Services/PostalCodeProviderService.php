<?php

namespace App\Services;

use App\DTO\PostalCodeResponseDTO;
use App\Enums\HttpStatusCode;
use App\Interfaces\PostalCodeServiceInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PostalCodeProviderService implements PostalCodeServiceInterface
{
  private static $cepLength = 8;

  public function __construct(private readonly Http $http)
  {
  }

  public function getAddresByPostalCode(int $cep): \Illuminate\Http\JsonResponse
  {
    $request = $this->handleRequest($cep);

    $request = $this->verifyRetriveSuccess($request);

    $request = $this->verifyExistsData($request);

    return response()->json([
      'data' => $this->buildResponseData($request->json()['items'][0])
    ], HttpStatusCode::OK->value);
  }

  private function verifyExistsData($request)
  {
    return empty($request['items']) ? $this->notFound() : $request;
  }

  private function verifyRetriveSuccess($request)
  {
    return !$request->successful() ? $this->notSuccess() : $request;
  }

  private function notFound()
  {
    return response()->json(
      [
        'error' => 'CEP não encontrado'
      ],
      HttpStatusCode::BadRequest->value
    );
  }

  private function notSuccess()
  {
    return response()->json(
      [
        'error' => 'Erro inesperado aconteceu, contate o suporte'
      ],
      HttpStatusCode::BadRequest->value
    );
  }

  private function handleRequest(int $cep): Response
  {
    return $this->http::withOptions([
      'verify' => false
    ])
      ->withUrlParameters([
        'endpoint' => env('ENDPOINT'),
      ])
      ->withQueryParameters([
        'apiKey' => env('APIKEY'),
        'q' => $this->convertIntToString($cep),
      ])
      ->get("{+endpoint}/geocode");
  }

  private function convertIntToString(int $cep): string
  {
    return strlen($cep) < self::$cepLength ? sprintf('%08d', $cep) : $cep;
  }

  private function buildResponseData(array $data): PostalCodeResponseDTO
  {
    $responseData = json_encode($data);
    $response = json_decode($responseData);
    return new PostalCodeResponseDTO($response);
  }
}
