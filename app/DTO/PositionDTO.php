<?php

namespace App\DTO;

class PositionDTO
{
  public float $lat;
  public float $lng;

  public function __construct(array $data)
  {
    $this->lat = $data['lat'];
    $this->lng = $data['lng'];
  }
}
