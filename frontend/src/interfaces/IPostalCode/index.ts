export interface IPostalCode {
  data: Data
}

interface Data {
  title: string;
  localityType: string;
  address: IAddres;
  position: IPosition;
  mapView: IMapView;
}

interface IAddres {
  label: string;
  countryCode: string;
  countryName: string;
  stateCode: string;
  state: string;
  city: string;
  district: string;
  postalCode: string;
}

interface IPosition {
  lat: number;
  lng: number;
}

interface IMapView {
  west: number;
  south: number;
  east: number;
  north: number;
}
