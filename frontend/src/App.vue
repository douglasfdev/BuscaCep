<script setup lang="ts">
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger
} from './components/ui/accordion';
import { Button } from './components/ui/button';
import { Input } from './components/ui/input'
import { ref } from 'vue';
import { IPostalCode } from '@interface/IPostalCode';
import { AxiosResponse } from 'axios';
import { AxiosHttpService } from './service/Http/AxiosHttpService';

const datas = ref<IPostalCode[]>([]);
const cepInput = ref('');
const city = ref('');

async function searchAddressByPostalCode(cep: string) {
  const service = await new AxiosHttpService().get<AxiosResponse>(`cep/${cep}`);

  if (service.status !== 200) return alert('Não foi');

  const { data } = service.data as IPostalCode;

  datas.value.push({ data });

  city.value = data.address.city;
};

</script>


<template>
  <div>
    <div class="flex w-full justify-center">
      <a href="https://vitejs.dev" target="_blank">
        <img src="/vite.svg" class="logo" alt="Vite logo" />
      </a>
      <a href="https://vuejs.org/" target="_blank">
        <img src="./assets/vue.svg" class="logo vue" alt="Vue logo" />
      </a>
    </div>
    <Input id="postalCode" type="text" placeholder="00000-000" v-model="cepInput" />
    <Button id="searchAddressButton" variant="outline" @click="searchAddressByPostalCode(cepInput)"
      class="flex w-full justify-center">
      Consultar Cep
    </Button>
    <Accordion type="single" class="w-full">
      <AccordionItem v-for="({ data }, id) in datas" :key="id + 1" :value="data.title">
        <AccordionTrigger class="address-title"> {{ data.address.city }} </AccordionTrigger>
        <AccordionContent> {{ id + 1 }}|{{ data.address.countryCode }} </AccordionContent>
      </AccordionItem>
    </Accordion>
  </div>
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}

.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}

.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
