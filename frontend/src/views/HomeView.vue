<template>
  <div class="row g-2">
    <div v-for="address in addresses" :key="address.id" class="col-sm-12 col-md-4 col-lg-3">
      <AddressCard :id="address.id" :street="address.street" :neighborhood="address.neighborhood" :city="address.city"
        :state="address.state" :cep="address.cep">
      </AddressCard>
    </div>
  </div>

  <DeleteModal></DeleteModal>
</template>

<script setup lang="ts">
import AddressCard from '@/components/AddressCard.vue';
import DeleteModal from '@/components/DeleteModal.vue';

const addresses = [
  {
    id: 1,
    street: 'Rua Teste',
    neighborhood: 'Bairro Teste',
    city: 'Cidade',
    state: 'TS',
    cep: '000000-000',
  },
  {
    id: 2,
    street: 'Rua Teste 2',
    neighborhood: 'Bairro Teste 2',
    city: 'City',
    state: 'JS',
    cep: '000000-001',
  }
]
</script>
