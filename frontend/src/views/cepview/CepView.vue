<script setup lang="ts">
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger
} from '../../components/ui/accordion';
import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
  CardFooter
} from '../../components/ui/card'
import { Button } from '../../components/ui/button';
import { Input } from '../../components/ui/input'
import { ref } from 'vue';
import { IPostalCode } from '@interface/IPostalCode';
import { AxiosResponse } from 'axios';
import { AxiosHttpService } from '../../infra/domain/Http/AxiosHttpService';

const postalAddress = ref<IPostalCode[]>([]);
const cepInput = ref<string>('');
const errorMessage = ref<string>('')
const addressTitle = ref<string>();

function formatPostalCode() {
  cepInput.value = cepInput.value.replace(/\D/g, '');
  if (cepInput.value.length > 5) {
    cepInput.value = cepInput.value.replace(/^(\d{5})(\d{0,3}).*/, '$1-$2');
  }
}

function clearErrorMessage() {
  setTimeout(() => {
    errorMessage.value = '';
  }, 2000); // 2000 milissegundos = 2 segundos
}

async function searchAddressByPostalCode(cep: string) {
  if (!cep) {
    errorMessage.value = "Por favor, preencha o campo de CEP.";
    clearErrorMessage();
    return;
  }

  errorMessage.value = "";
  try {
    const service = await new AxiosHttpService().get<AxiosResponse>(`cep/${cep.replace(/\D/g, '')}`);

    if (service.status !== 200) errorMessage.value = 'Serviço de busca fora do ar';

    const { data } = service.data as IPostalCode;

    addressTitle.value = data.address.city
    postalAddress.value.push({ data });
  } catch (e) {
    errorMessage.value = "";
    if (e instanceof Error) {
      errorMessage.value = e.message
    }
    clearErrorMessage();
  }
};
</script>

<template>
  <div class="flex flex-col items-center justify-center">
    <Card class="w-full max-w-lg mx-auto px-4 mt-10">
      <CardHeader class="mb-4">
        <CardTitle>Encontre seu Endereço</CardTitle>
        <CardDescription>Utilitário para você encontrar seu endereço</CardDescription>
      </CardHeader>
      <CardContent class="flex flex-col items-center">
        <Input class="text-black mb-4 postal-code" type="string" placeholder="00000-000" @input="formatPostalCode"
          v-model="cepInput" />
        <Button variant="outline" @click="searchAddressByPostalCode(cepInput)"
          class="font-bold py-2 px-4 rounded hover:bg-blue-700 hover:text-white text-black search-address-button">
          Consultar Cep
        </Button>
      </CardContent>
      <CardFooter class="flex items-center justify-center">
        <span class="error-message bg-orange-600 rounded-md px-2 py-2 text-white" v-if="errorMessage"> {{ errorMessage
          }} </span>
      </CardFooter>
    </Card>
  </div>
  <div class="flex justify-center mt-14">
    <Accordion type="single" class=" w-2/6">
      <AccordionItem v-for="({ data }, id) in postalAddress" :key="id + 1" :value="data.title">
        <AccordionTrigger class="address-title mr-6">
          #{{ id + 1 }} | {{ addressTitle }}
          <span class="border-solid border-2 border-sky-500 rounded-md mr-4">
            latitude <span class="flex flec-col px-4"> {{ data.position.lat }}</span>
          </span>
          <span class="border-solid border-2 border-sky-500 rounded-md mr-2">
            longitude <span class="flex flec-col px-4"> {{ data.position.lng }} </span>
          </span>
        </AccordionTrigger>
        <AccordionContent>{{ data.title }} </AccordionContent>
        <AccordionContent>{{ data.address.countryCode }} </AccordionContent>
        <AccordionContent>{{ data.address.state }} | {{ data.address.stateCode }} </AccordionContent>
        <AccordionContent v-if="data.address.district && data.address.district.trim() !== ''">
          {{ data.address.district }}
        </AccordionContent>
        <AccordionContent class="border-solid border-2 border-sky-500 rounded-md mr-2">
          <span class="font-bold mt-4"> Oeste: </span> {{ data.mapView.west }}
        </AccordionContent>
        <AccordionContent class="border-solid border-2 border-sky-500 rounded-md mr-2">
          <span class="font-bold"> Sul: </span> {{ data.mapView.south }}
        </AccordionContent>
        <AccordionContent class="border-solid border-2 border-sky-500 rounded-md mr-2">
          <span class="font-bold"> Leste: </span> {{ data.mapView.east }}
        </AccordionContent>
        <AccordionContent class="border-solid border-2 border-sky-500 rounded-md mr-2">
          <span class="font-bold"> Norte: </span> {{ data.mapView.north }}
        </AccordionContent>
      </AccordionItem>
    </Accordion>
  </div>
</template>
