<template>
  <div v-if="addresses.length !== 0" class="row g-2">
    <div v-for="address in addresses" :key="address.id" class="col-sm-12 col-md-4 col-lg-3">
      <AddressCard :id="address.id" :street="address.street" :neighborhood="address.neighborhood" :city="address.city"
        :state="address.state" :cep="address.cep">
      </AddressCard>
    </div>
  </div>
  <div v-else class="text-center mt-5">
    <h1>
      Nenhum Endereço Encontado
      <i class="bi bi-x-octagon"></i>
    </h1>
  </div>
</template>

<script setup lang="ts">
import AddressCard from '@/components/AddressCard.vue';

import { computed } from 'vue';
import { useAddressStore } from '@/stores/AddressStore';

const addressStore = useAddressStore();

const addresses = computed(() => addressStore.addressesList);
</script>
