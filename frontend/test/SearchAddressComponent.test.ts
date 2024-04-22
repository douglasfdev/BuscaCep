import MockAdapter from 'axios-mock-adapter';
import CepView from '../src/views/cepview/CepView.vue';
import { mount } from '@vue/test-utils';
import axios, { AxiosResponse } from 'axios';
import { AxiosHttpService } from '../src/infra/domain/Http/AxiosHttpService';

describe('SearchAddressComponent', () => {
  let mockAxios: MockAdapter;

  beforeEach(() => {
    mockAxios = new MockAdapter(axios);
  })
  afterEach(() => {
    mockAxios.restore();
  });

  test('should return a city', async () => {
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

    const wrapper = mount(CepView, {});

    await wrapper.get(".postal-code").setValue("01512010");

    mockAxios.onGet(`http://127.0.0.1:8000/api/cep/01512010`).reply(200, mockResponse);

    await wrapper.get(".search-address-button").trigger("click");
    const service = new AxiosHttpService();
    const get = await service.get(`cep/01512010`) as AxiosResponse;

    expect(wrapper.find(".error-message").exists()).toBeFalsy();
    expect(get.data.data.title).toBe("01512-010, São Paulo, SP, Brasil");

    expect(wrapper.get(".address-title").text()).toBe("#1 | São Paulo  latitude -23.55329 longitude -46.62877");
  })
});