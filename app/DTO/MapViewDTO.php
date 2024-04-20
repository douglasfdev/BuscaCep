<?php

namespace App\DTO;

class MapViewDTO
{
  public float $west;
  public float $south;
  public float $east;
  public float $north;

  public function __construct(array $data)
  {
    $this->west = $data['west'];
    $this->south = $data['south'];
    $this->east = $data['east'];
    $this->north = $data['north'];
  }
}
