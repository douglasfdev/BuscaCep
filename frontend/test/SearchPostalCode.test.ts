import {
  afterEach,
  beforeEach,
  describe,
  expect,
  it,
} from 'vitest';
import MockAdapter from 'axios-mock-adapter';
import axios, { AxiosResponse } from 'axios';
import { AxiosHttpService } from '../src/infra/domain/Http/AxiosHttpService';

describe('Search cep', () => {
  let mockAxios: MockAdapter;

  beforeEach(() => {
    mockAxios = new MockAdapter(axios);
  })
  afterEach(() => {
    mockAxios.restore();
  });

  it('Should fetch address data correctly', async () => {
    const mockPostalCode = '01512010';
    const mockResponse = {
      status: 200,
      data: {
        title: "01512-010, São Paulo, SP, Brasil",
        localityType: "postalCode",
        address: {
          label: "01512-010, São Paulo, SP, Brasil",
          countryCode: "BRA",
          countryName: "Brasil",
          stateCode: "SP",
          state: "São Paulo",
          city: "São Paulo",
          district: "Sé",
          postalCode: "01512-010"
        },
        position: {
          lat: -23.55329,
          lng: -46.62877
        },
        mapView: {
          west: -46.6299,
          south: -23.5543,
          east: -46.62739,
          north: -23.55267
        }
      }
    };

    mockAxios.onGet(`http://127.0.0.1:8000/api/cep/${mockPostalCode}`).reply(200, mockResponse);
    const service = new AxiosHttpService();
    const get = await service.get(`cep/${mockPostalCode}`) as AxiosResponse;

    expect(get.data).toEqual(mockResponse);
  });
});
