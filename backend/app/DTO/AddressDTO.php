<?php

namespace App\DTO;

use stdClass;

class AddressDTO
{
  public string $label;
  public string $countryCode;
  public string $countryName;
  public string $stateCode;
  public string $state;
  public string $city;
  public ?string $district;
  public string $postalCode;

  public function __construct(stdClass $data)
  {
    $this->label = $data->label;
    $this->countryCode = $data->countryCode;
    $this->countryName = $data->countryName;
    $this->stateCode = $data->stateCode;
    $this->state = $data->state;
    $this->city = $data->city;
    $this->district = $data->district ?? null;
    $this->postalCode = $data->postalCode;
  }
}
