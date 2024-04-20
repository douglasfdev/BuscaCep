<?php

use App\Services\AddressService;
use App\Services\PostalCodeProviderService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

it('can retrieve address information by cep', function () {
    // Mock the response from the API
    Http::fake([
        'https://geocode.search.hereapi.com/v1/geocode?q=01512010&apiKey=be1hHQrytN0izt1ZAfwMHj5NLwdG0AHGBBb13FUjcGk' => Http::response([
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
        ], 200),
    ]);

    // Instantiate the AddressService
    $addressService = new PostalCodeProviderService(new Http());

    // Call the method to get address information
    $response = $addressService->getAddresByPostalCode(1512010); // Modified to pass a string
    $content = $response->getContent();
    $data = json_decode($content, true);

    // Assert that the response contains the expected address information
    expect($data)->toBe([
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
    ]);
});
