<template>
  <li class="nav-item">
    <router-link :to="{ name: toPath }" class="nav-link">
      <button type="button" :class="btnClass" class="colapsed__full-width">
        {{ label }}
        <i :class="iconClass"></i>
      </button>
    </router-link>
  </li>
</template>

<script setup lang="ts">
import type { RouteRecordName } from 'vue-router';

defineProps<{
  toPath: RouteRecordName,
  label: String,
  btnClass: String,
  iconClass: String,
}>();
</script>

<style scoped>
.colapsed__full-width {
  width: 100%;
}
</style>
