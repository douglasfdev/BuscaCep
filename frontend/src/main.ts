import { createApp } from 'vue';
import './style.css';
import App from './App.vue';
import router from "./router/index.ts";
import { SearchPostalCodeGateway } from './infra/Gateway/SearchPostalCodeGateway.ts';
import { AxiosHttpService } from './infra/Http/AxiosHttpService.ts';

createApp(App).provide("searchPostalCode", new SearchPostalCodeGateway(new AxiosHttpService())).use(router).mount('#app')
