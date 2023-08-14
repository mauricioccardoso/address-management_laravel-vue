<template>
  <SearchCard></SearchCard>
  <div class="row g-2">
    <div v-for="address in addresses" :key="address.cep" class="col-sm-12 col-md-4 col-lg-3">
      <AddressCard :id="address.id" :street="address.street" :neighborhood="address.neighborhood" :city="address.city"
        :state="address.state" :cep="address.cep">
      </AddressCard>
    </div>
  </div>
</template>

<script setup lang="ts">
import AddressCard from '@/components/AddressCard.vue';
import SearchCard from '@/components/search/SearchCard.vue';
import { useAddressStore } from '@/stores/AddressStore';
import { computed } from 'vue';

const addressStore = useAddressStore();

const addresses = computed(() => addressStore.addressesSearch);
</script>