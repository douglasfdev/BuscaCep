export interface IHttpRequest {
  get<T = any>(url: string): Promise<T>;
}