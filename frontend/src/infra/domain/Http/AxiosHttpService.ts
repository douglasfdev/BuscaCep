import { IHttpRequest } from '@interface/IHttpRequest';
import axios, { AxiosInstance } from 'axios';

export class AxiosHttpService implements IHttpRequest {
  private readonly instance: AxiosInstance;

  constructor() {
    this.instance = axios.create({
      baseURL: 'http://127.0.0.1:8000/api/',
      headers: {
        'Content-Type': 'application/json',
      },
    })
  }

  async get<T>(url: string): Promise<T> {
    return this.instance.get(url);
  }
}