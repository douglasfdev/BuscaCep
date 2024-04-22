<?php

use App\Http\Controllers\PostalCodeProviderController;
use App\Services\PostalCodeProviderService;
use Illuminate\Support\Facades\Http;

it('returns status 200', function () {
  Http::fake([
    'https://geocode.search.hereapi.com/v1/geocode?q=01512010&apiKey=be1hHQrytN0izt1ZAfwMHj5NLwdG0AHGBBb13FUjcGk' => Http::response([], 200),
  ]);

  $controller = new PostalCodeProviderController(new PostalCodeProviderService(new Http()));

  $response = $controller->getAddresByPostalCode(1512010);

  $this->assertEquals(200, $response->getStatusCode());
});
