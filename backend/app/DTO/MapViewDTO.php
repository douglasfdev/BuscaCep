<?php

namespace App\DTO;

use stdClass;

class MapViewDTO
{
  public float $west;
  public float $south;
  public float $east;
  public float $north;

  public function __construct(stdClass $data)
  {
    $this->west = $data->west;
    $this->south = $data->south;
    $this->east = $data->east;
    $this->north = $data->north;
  }
}
