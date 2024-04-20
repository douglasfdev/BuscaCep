<?php

namespace App\DTO;

use stdClass;

class PositionDTO
{
  public float $lat;
  public float $lng;

  public function __construct(stdClass $data)
  {
    $this->lat = $data->lat;
    $this->lng = $data->lng;
  }
}
