<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface IPostalCode
{
  /**
   * @param string $cep Cep to search
   * @return \Illuminate\Http\JsonResponse Response json of request
   */
  public function getAddresByPostalCode(int $cep);
}
