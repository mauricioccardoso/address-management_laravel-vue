<script setup lang="ts">
import { RouterView } from 'vue-router'
</script>

<template>
  <main class="container">
    <RouterView />
  </main>
</template>

<style scoped>
.container {
  min-height: 100vh;

  display: grid;
  place-items: center;
  text-align: center;
}
</style>
