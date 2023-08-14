<template>
  <div class="modal fade" :id="modalId" tabindex="-1" :aria-labelledby="modalId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form @submit.prevent="submitAddressForm">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="createUpdateAddressModalLabel">{{ modalTitle }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ref="closeModal"></button>
          </div>
          <div class="modal-body">

            <!-- form -->
            <div class="row g-2 mb-2">
              <div class="col-md">
                <div class="input-group has-validation">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="cep" placeholder="00000-000" v-model="formData.cep"
                      @input="formatCep" required minlength="9" maxlength="9">
                    <label for="cep">CEP: 00000-000</label>
                  </div>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control" id="street" placeholder="Rua" v-model="formData.street" required
                    minlength="3">
                  <label for="street">Logradouro</label>
                </div>
              </div>
            </div>
            <div class="row g-2 mb-2">
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control" id="neighborhood" placeholder="Bairro"
                    v-model="formData.neighborhood" minlength="3">
                  <label for="neighborhood">Bairro</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control" id="city" placeholder="Cidade" v-model="formData.city"
                    minlength="3">
                  <label for="city">Cidade</label>
                </div>
              </div>
            </div>
            <div class="row g-2">
              <div class="col-md">
                <div class="form-floating">
                  <select class="form-select" id="state" v-model="formData.state" required>
                    <option selected disabled value=""> Selecione o Estado </option>
                    <option v-for="state in  states " :key="state.abbreviation" :value="state.abbreviation">
                      {{ state.name }} - {{ state.abbreviation }}
                    </option>
                  </select>
                  <label for="state">Estado</label>
                </div>
              </div>
              <small class="text-danger text-opacity-75">* Todos os campos são obrigatórios</small>
            </div>
            <!-- form -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, onMounted, ref, type Ref } from 'vue';
import { useformAddressData } from '@/stores/formAddressData';
import { apiViaCep } from '@/http/viaCep';

import { states } from '@/data/states';
import { useAddressStore } from '@/stores/AddressStore';

const props = defineProps<{
  modalId: string,
}>();

const storeFormAddressData = useformAddressData();
const addressStore = useAddressStore();

const formData = computed(() => storeFormAddressData.addressData);
const modalTitle = computed(() => storeFormAddressData.titleModal);

// Add event to clear form on modal close
onMounted(() => {
  const modalElement = document.getElementById(props.modalId);
  modalElement?.addEventListener('hidden.bs.modal', storeFormAddressData.clearForm);
});

// Format Cep
const formatCep = async (event: any) => {
  const numericValue: string = event.target.value.replace(/\D/g, '');

  const firstPart: string = numericValue.slice(0, 5);
  const secondPart: string = numericValue.slice(5, 8);

  if (numericValue.length >= 6) {
    formData.value.cep = `${firstPart}-${secondPart}`;
  } else {
    formData.value.cep = `${firstPart}`;
    return;
  }

  if (numericValue.length === 8) {
    const cep = formData.value.cep.replace('-', "");
    getAddressApiViaCEP(cep);
  }
}

// Get address data from viaCEP api
const getAddressApiViaCEP = async (cep: string) => {
  const response = await apiViaCep(cep);

  if (!response.erro) {
    formData.value.street = response.logradouro;
    formData.value.neighborhood = response.bairro;
    formData.value.city = response.localidade;
    formData.value.state = response.uf;
  }
}

const closeModal: Ref<any> = ref(null)
// Send data to backend
const submitAddressForm = () => {
  if (closeModal.value) {
    closeModal.value.click()
  }

  if (!formData.value.id) {
    addressStore.save(formData.value)
  }

  if (formData.value.id) {
    addressStore.update(formData.value)
  }
}
</script>