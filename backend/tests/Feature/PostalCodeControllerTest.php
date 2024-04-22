<?php

use App\Http\Controllers\PostalCodeProviderController;
use App\Services\PostalCodeProviderService;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

it('returns respose body by postal code', function () {
  $responseBody = [
    "items" => [
      [
        "title" => "01512-010, São Paulo, SP, Brasil",
        "id" => "here:cm:namedplace:24279933",
        "resultType" => "locality",
        "localityType" => "postalCode",
        "address" => [
          "label" => "01512-010, São Paulo, SP, Brasil",
          "countryCode" => "BRA",
          "countryName" => "Brasil",
          "stateCode" => "SP",
          "state" => "São Paulo",
          "city" => "São Paulo",
          "district" => "Sé",
          "postalCode" => "01512-010"
        ],
        "position" => [
          "lat" => -23.55329,
          "lng" => -46.62877
        ],
        "mapView" => [
          "west" => -46.6299,
          "south" => -23.5543,
          "east" => -46.62739,
          "north" => -23.55267
        ],
        "scoring" => [
          "queryScore" => 1.0,
          "fieldScore" => [
            "postalCode" => 1.0
          ]
        ]
      ]
    ]
  ];

  Http::fake([
    'https://geocode.search.hereapi.com/v1/geocode?q=01512010&apiKey=be1hHQrytN0izt1ZAfwMHj5NLwdG0AHGBBb13FUjcGk' => Http::response(
      json_encode($responseBody),
      200
    ),
  ]);

  $controller = new PostalCodeProviderController(new PostalCodeProviderService(new Http()));

  $response = $controller->getAddresByPostalCode(1512010);
  $responseBodyController = [
    "data" => [
      "title" => "01512-010, São Paulo, SP, Brasil",
      "localityType" => "postalCode",
      "address" => [
        "label" => "01512-010, São Paulo, SP, Brasil",
        "countryCode" => "BRA",
        "countryName" => "Brasil",
        "stateCode" => "SP",
        "state" => "São Paulo",
        "city" => "São Paulo",
        "district" => "Sé",
        "postalCode" => "01512-010"
      ],
      "position" => [
        "lat" => -23.55329,
        "lng" => -46.62877
      ],
      "mapView" => [
        "west" => -46.6299,
        "south" => -23.5543,
        "east" => -46.62739,
        "north" => -23.55267
      ]
    ]
  ];

  expect($response)->toBeInstanceOf(JsonResponse::class);

  $decodedResponse = is_string($response->getContent()) ? json_decode($response->getContent(), true) : $response->getContent();

  expect($decodedResponse)->toEqual($responseBodyController);
});
