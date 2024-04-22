import { IHttpClient } from "../Http";

export class SearchPostalCodeGateway {
  constructor(private readonly httpClient: IHttpClient) { }

  async byCep<T = any>(ulr: string): Promise<T> {
    return this.httpClient.get<T>(`http://127.0.0.1:8000/api/cep/${ulr}`);
  }
}