<script setup lang="ts">
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger
} from './components/ui/accordion';

const defaultValue = 'item-1';
const accordionItems = [
  { value: 'item-1', title: 'Ola mundo', content: 'xpto' },
  { value: 'item-2', title: 'Tamo por aqui', content: 'xpto' },
  { value: 'item-3', title: 'tchau mundo', content: 'xpto' },
];

</script>


<template>
  <div>
    <div class="flex w-full justify-center h-full">
      <a href="https://vitejs.dev" target="_blank">
        <img src="/vite.svg" class="logo" alt="Vite logo" />
      </a>
      <a href="https://vuejs.org/" target="_blank">
        <img src="./assets/vue.svg" class="logo vue" alt="Vue logo" />
      </a>
    </div>
    <Accordion type="single" class="w-full" :default-value="defaultValue">
      <AccordionItem v-for="item in accordionItems" :key="item.value" :value="item.value">
        <AccordionTrigger> {{ item.title }} </AccordionTrigger>
        <AccordionContent> {{ item.content }} </AccordionContent>
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
