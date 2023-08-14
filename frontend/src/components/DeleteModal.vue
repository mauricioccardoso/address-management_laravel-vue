<template>
  <div class="modal fade" id="deleteAddress" tabindex="-1" aria-labelledby="deleteAddressLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteAddressLabel">Deseja Deletar o Endereço?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5 class="card-title mb-2">{{ addressData.street }}</h5>
          <p class="card-text">{{ addressData.neighborhood }}, {{ addressData.city }} - {{ addressData.state }}, {{
            addressData.cep }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="deleteAddress">Sim</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useformAddressData } from '@/stores/formAddressData';
import { computed } from 'vue';

const storeFormAddressData = useformAddressData();
const addressData = computed(() => storeFormAddressData.addressData);

const deleteAddress = () => {
  console.log('delete', addressData.value);
}
</script>