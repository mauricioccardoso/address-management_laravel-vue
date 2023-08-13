<template>
  <header>
    <NavBar label="Endereço">
      <NavLink @click="changeView" :toPath="navLinkToPath" :label="navLinkLabel" btnClass="btn btn-secondary"
        :iconClass="navLinkIcon" />
      <NavButton label="Novo" btn-class="btn btn-success" icon-class="bi bi-plus-circle" />
    </NavBar>
    <div class="pb-2 mb-4 border-bottom border-success"></div>
  </header>

  <main>
    <RouterView />
  </main>
</template>

<script setup lang="ts">
import NavBar from '@/components/navbar/NavBar.vue';
import NavLink from '@/components/navbar/NavLink.vue';
import NavButton from '@/components/navbar/NavButton.vue';
import { RouterView } from 'vue-router'

import { ref } from 'vue';

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
</script>