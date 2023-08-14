<template>
  <div class="container min-vh-100 app-bg p-3">
    <RouterView />
  </div>
</template>

<script setup lang="ts">
import { RouterView } from 'vue-router'
import { useAddressStore } from './stores/AddressStore';

const addressListStore = useAddressStore();

addressListStore.listAddress();
</script>