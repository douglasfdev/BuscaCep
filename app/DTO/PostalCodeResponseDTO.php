<?php

namespace App\DTO;

use stdClass;

class PostalCodeResponseDTO
{
  public string $title;
  public string $localityType;
  public AddressDTO $address;
  public PositionDTO $position;
  public MapViewDTO $mapView;

  public function __construct(stdClass $data)
  {
    $this->title = $data->title;
    $this->localityType = $data->localityType;
    $this->address = new AddressDTO($data->address);
    $this->position = new PositionDTO($data->position);
    $this->mapView = new MapViewDTO($data->mapView);
  }
}
