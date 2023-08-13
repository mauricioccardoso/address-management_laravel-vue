<template>
  <div class="row g-2">
    <div v-for="address in addresses" :key="address.id" class="col-sm-12 col-md-4 col-lg-3">
      <AddressCard :street="address.street" :neineighborhood="address.neineighborhood" :city="address.city"
        :state="address.state" :cep="address.cep">
      </AddressCard>
    </div>
  </div>
</template>

<script setup lang="ts">
import AddressCard from '@/components/AddressCard.vue';

const addresses = [
  {
    id: 1,
    street: 'Rua Teste',
    neineighborhood: 'Bairro Teste',
    city: 'Cidade',
    state: 'TS',
    cep: '000000-000',
  },
  {
    id: 2,
    street: 'Rua Teste 2',
    neineighborhood: 'Bairro Teste 2',
    city: 'City',
    state: 'JS',
    cep: '000000-001',
  }
]
</script>
