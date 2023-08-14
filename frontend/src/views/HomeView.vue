<template>
  <div class="row g-2">
    <div v-for="address in addresses" :key="address.id" class="col-sm-12 col-md-4 col-lg-3">
      <AddressCard :id="address.id" :street="address.street" :neighborhood="address.neighborhood" :city="address.city"
        :state="address.state" :cep="address.cep">
      </AddressCard>
    </div>
  </div>
</template>

<script setup lang="ts">
import AddressCard from '@/components/AddressCard.vue';

import { computed } from 'vue';
import { useAddressStore } from '@/stores/AddressStore';

const addressStore = useAddressStore();

const addresses = computed(() => addressStore.addressesList);
</script>
