export interface IHttpRequest {
  get<T>(url: string): Promise<T>;
}