<template>
  <SearchCard></SearchCard>
  <div v-if="addressesSearch.length !== 0" class="row g-2">
    <div v-for="addressSearch in addressesSearch" :key="addressSearch.cep" class="col-sm-12 col-md-4 col-lg-3">
      <AddressCard :id="addressSearch.id" :street="addressSearch.street" :neighborhood="addressSearch.neighborhood"
        :city="addressSearch.city" :state="addressSearch.state" :cep="addressSearch.cep">
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
import SearchCard from '@/components/search/SearchCard.vue';
import { useAddressStore } from '@/stores/AddressStore';
import { computed, watch } from 'vue';

const addressStore = useAddressStore();

const addressesSearch = computed(() => addressStore.addressesSearch);
</script>