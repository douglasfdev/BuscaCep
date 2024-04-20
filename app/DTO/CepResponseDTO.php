<?php

namespace App\DTO;

class CepResponseDTO
{
  public string $title;
  public string $localityType;
  public AddressDTO $address;
  public PositionDTO $position;
  public MapViewDTO $mapView;

  public function __construct(array $data)
  {
    $this->title = $data['title'];
    $this->localityType = $data['localityType'];
    $this->address = new AddressDTO($data['address']);
    $this->position = new PositionDTO($data['position']);
    $this->mapView = new MapViewDTO($data['mapView']);
  }
}
