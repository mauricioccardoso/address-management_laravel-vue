<template>
  <header>
    <NavBar label="Endereços">
      <NavLink @click="changeView" :toPath="navLinkToPath" :label="navLinkLabel" btnClass="btn btn-secondary"
        :iconClass="navLinkIcon" />
      <NavButton label="Novo" btn-class="btn btn-success" icon-class="bi bi-plus-circle" data-bs-toggle="modal"
        data-bs-target="#createEditAddressModal" @click="openCreateAddressModal" />
    </NavBar>
    <div class="pb-2 mb-4 border-bottom border-success"></div>
  </header>

  <main>
    <RouterView />
    <AddressModal modalId="createEditAddressModal"></AddressModal>
    <DeleteModal></DeleteModal>
  </main>
</template>

<script setup lang="ts">
import NavBar from '@/components/navbar/NavBar.vue';
import NavLink from '@/components/navbar/NavLink.vue';
import NavButton from '@/components/navbar/NavButton.vue';
import AddressModal from '@/components/AddressModal.vue';
import DeleteModal from '@/components/DeleteModal.vue';

import { RouterView } from 'vue-router';
import { ref } from 'vue';
import { useformAddressData } from '@/stores/formAddressData';

const navLinkLabel = ref('Buscar');
let navLinkToPath = 'search';
let navLinkIcon = 'bi bi-search';

const changeView = () => {
  if (navLinkLabel.value === 'Buscar') {
    navLinkLabel.value = 'Home'
    navLinkToPath = 'home'
    navLinkIcon = 'bi bi-house-fill';
  } else if (navLinkLabel.value === 'Home') {
    navLinkLabel.value = 'Buscar'
    navLinkToPath = 'search'
    navLinkIcon = 'bi bi-search';
  }
}

const formAddressData = useformAddressData();

const openCreateAddressModal = () => {
  const data = {
    id: null,
    cep: null,
    street: null,
    neighborhood: null,
    city: null,
    state: null,
  }

  formAddressData.openModal('Adicionar Novo Endereço', data);
}
</script>