<script setup>
import { ref } from 'vue';
import CalculatePriceRow from './components/CalculatePriceRow.vue';

// We wish this to be set from the backend
const rows = ref([]);
const fees_title = ref(['Basic', 'Special', 'Association', 'Storage']);

// Function to add a new row
const addNewRow = () => {
  rows.value.push({});
};


</script>

<template>
  <h1 class="text-3xl font-bold underline text-500 pb-8">
    Hello, Progi!
  </h1>
  <div class="w-full">
    <div class="row  border-b-2 bg-gray-200 ">
      <div class="column w-24 font-bold">#</div>
      <div class="column w-40 font-bold">Price</div>
      <div class="column w-40 font-bold">type</div>
      
      <div v-for="(fee, index) in fees_title" :key="index" class="column w-24 font-bold">
        {{ fee }}
      </div>

      <!-- Last Column: Total -->
      <div class="column font-bold">Total</div>
    </div>
    <div v-for="(row, index) in rows" :key="index">
      <CalculatePriceRow :row_number="index+1"  />
    </div>
    <div class="text-left pt-8">
      <button class="w-40 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded " @click="addNewRow">Add new row</button>
    </div>
  </div>
</template>

<style scoped>
/* Add any styles you need here */
</style>