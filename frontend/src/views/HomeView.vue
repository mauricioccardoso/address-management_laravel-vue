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
import { useAddressListStore } from '@/stores/AddressListStore';
import { computed } from 'vue';

const addressListStore = useAddressListStore();

const addresses = computed(() => addressListStore.addressList);
</script>
