<template>
  <div class="card mb-3">
    <div class="card-header">
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" v-model="checkValue">
        <label class="form-check-label fw-bold" for="flexSwitchCheckChecked">Buscar Por: {{ searchType }}</label>
      </div>
    </div>
    <div class="card-body">
      <form class="col" @submit.prevent="searchAddress">
        <Transition name="fade" mode="out-in">
          <div v-if="!checkValue" class="col-sm-12 col-md-4 mb-2">
            <div class="input-group has-validation">
              <div class="form-floating">
                <input type="text" class="form-control" id="cep" placeholder="00000-000" required minlength="9"
                  maxlength="9" v-model="cepSearch.cep" @input="formatCep">
                <label for="cep">CEP: 00000-000</label>
              </div>
            </div>
          </div>
          <div v-else>
            <div class="row g-2 mb-2">
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control" id="street" placeholder="Rua" required minlength="3"
                    v-model="addressSearch.street">
                  <label for="street">Logradouro</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control" id="neighborhood" placeholder="Bairro" minlength="3"
                    v-model="addressSearch.neighborhood">
                  <label for="neighborhood">Bairro</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control" id="city" placeholder="Cidade" required minlength="3"
                    v-model="addressSearch.city">
                  <label for="city">Cidade</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <select class="form-select" id="state" required v-model="addressSearch.state">
                    <option selected disabled value=""> Selecione o Estado </option>
                    <option v-for="state in  states " :key="state.abbreviation" :value="state.abbreviation">
                      {{ state.name }} - {{ state.abbreviation }}
                    </option>
                  </select>
                  <label for="state">Estado</label>
                </div>
              </div>
            </div>
          </div>
        </Transition>
        <div class="d-flex justify-content-between flex-column flex-sm-row gap-2">
          <small class="text-danger text-opacity-75">{{ alertMessage }}</small>
          <button type="submit" class="btn btn-success">
            Buscar
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { states } from '@/data/states';
import { useAddressStore } from '@/stores/AddressStore';

import { computed, ref, watch, type Ref } from 'vue';

const addressStore = useAddressStore();

const checkValue = ref(false);
const searchType = computed(() => checkValue.value ? 'Endereço' : 'CEP');
const alertMessage = computed(() => checkValue.value ? '* Todos os campos são obrigatórios, exceto o bairro.' : '* O campo CEP é obrigatório');

interface cepSearchDTO {
  cep: string | null,
}

interface addressSearchDTO {
  street: string | null,
  neighborhood: string | null,
  city: string | null,
  state: string | null,
}

const cepSearch: Ref<cepSearchDTO> = ref({
  cep: null,
})

const addressSearch: Ref<addressSearchDTO> = ref({
  street: null,
  neighborhood: null,
  city: null,
  state: null,
});

watch(searchType, () => {
  if (searchType.value !== 'CEP') {
    cepSearch.value.cep = null
  } else {
    addressSearch.value = {
      street: null,
      neighborhood: null,
      city: null,
      state: null,
    }
  }
});

const formatCep = async (event: any) => {
  const numericValue: string = event.target.value.replace(/\D/g, '');

  const firstPart: string = numericValue.slice(0, 5);
  const secondPart: string = numericValue.slice(5, 8);

  if (numericValue.length >= 6) {
    cepSearch.value.cep = `${firstPart}-${secondPart}`;
  } else {
    cepSearch.value.cep = `${firstPart}`;
    return;
  }
}


const searchAddress = () => {
  let data = {}
  if (cepSearch.value.cep) {
    data = cepSearch.value;
  }

  if (!cepSearch.value.cep) {
    data = addressSearch.value;
  }

  addressStore.search(data);
}

</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.20s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>