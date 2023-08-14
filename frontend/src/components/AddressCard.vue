<template>
  <div class="card h-100">
    <div class="card-body d-flex flex-column justify-content-between">
      <div class="mb-3">
        <h5 class="card-title">{{ street }}</h5>
        <p class="card-text">{{ neighborhood }}, {{ city }} - {{ state }}, {{ cep }}</p>
      </div>
      <div class="d-flex justify-content-evenly">
        <button class="btn btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#createEditAddressModal"
          @click="openEditAddressModal">
          Editar
          <i class="bi bi-pencil-fill fs-"></i>
        </button>
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAddress"
          @click="openDeleteAddressModal">
          Excluir
          <i class="bi bi-trash2-fill"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useformAddressData } from '@/stores/formAddressData';

const props = defineProps<{
  id: number,
  cep: string,
  street: string,
  neighborhood: string,
  city: string,
  state: string,
}>();

const formAddressData = useformAddressData();

const openEditAddressModal = () => {
  const data = { ...props }
  formAddressData.openModal('Editar Endereço', data);
}

const openDeleteAddressModal = () => {
  const data = { ...props }
  formAddressData.deleteAddressModal(data);
}

</script>