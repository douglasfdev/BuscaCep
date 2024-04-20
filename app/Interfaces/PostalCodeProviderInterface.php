<?php

namespace App\Interfaces;

interface PostalCodeProviderInterface
{
  /**
   * @param string $cep Cep to search
   * @return \Illuminate\Http\JsonResponse Response json of request
   */
  public function getAddresByPostalCode(string $cep): \Illuminate\Http\JsonResponse;
}
