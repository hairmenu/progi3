<template>
  <div class="error_message text-red-500 font-bold" v-if="error_message">{{ error_message }}</div>
  <div class="row  border-b-2">
    <div class="column w-24">{{ row_number }}</div>
    <div class="column w-40">
      <input v-model.number="vehiclePrice" @input="fetchFees" placeholder="Enter price" type="number" min="0" />
    </div>

    <div class="column w-40">
      <select v-model="vehicleType" @change="fetchFees">
        <!-- We wish the values to be set from the backend -->
        <option value=0>Choose</option>
        <option value="L">Luxury</option>
        <option value="C">Common</option>
      </select>
    </div>
    
    <div v-for="(fee, index) in fees" :key="index" class="column w-24">
      {{ fee }}
    </div>
    
    <div class="column">
      {{ total }}
    </div>
  </div>
  
</template>

<script>
import axios from 'axios';

export default {
  props: {
    row_number: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      vehiclePrice: '',
      vehicleType: 0,
      fees: Array(4).fill(null), // Initialize empty array for fees
      total: null,
      error_message: null,
    };
  },
  methods: {
    async fetchFees() {
      this.error_message=null;
      if (this.vehiclePrice && this.vehicleType != '' && this.vehicleType != 0) {
        try {
          this.error_message=null;
          await new Promise(resolve => setTimeout(resolve, 200));
          this.total = "Calculating...";
          this.fees = Array(4).fill("-")
          const response = await axios.get(`http://localhost/api/price/${this.vehiclePrice}/${this.vehicleType}`);
          this.fees = response.data.fees; // Take the first 5 items if there are more
          this.total = response.data.total;
        } catch (error) {
          console.error("Error fetching fees:", error);
          this.error_message="Error fetching fees";
        }
      }
    },
  },
};
</script>

<style>
.row {
  display: flex;
}
.column {
  flex: 1;
  padding: 5px;
}
input {
  width: 100%;
}
</style>
