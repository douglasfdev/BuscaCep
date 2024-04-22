import { IHttpRequest } from '@interface/IHttpRequest';
import axios, { AxiosInstance } from 'axios';

export class AxiosHttpService implements IHttpRequest {
  private readonly instance: AxiosInstance;

  constructor() {
    this.instance = axios.create({
      headers: {
        'Content-Type': 'application/json',
      },
    })
  }

  async get<T>(url: string): Promise<T> {
    return this.instance.get(url);
  }
}