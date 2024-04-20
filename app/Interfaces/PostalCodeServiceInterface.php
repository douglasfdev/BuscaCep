<?php

namespace App\Interfaces;

interface PostalCodeServiceInterface
{
  /**
   * @param string $cep Cep to search
   * @return \Illuminate\Http\JsonResponse Response json of request
   */
  public function getAddresByPostalCode(int $postalCode);
}
