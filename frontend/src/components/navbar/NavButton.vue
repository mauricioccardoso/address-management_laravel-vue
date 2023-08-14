<template>
  <li class="nav-item">
    <div class="nav-link">
      <button type="button" :class="btnClass" class="colapsed__full-width">
        {{ label }}
        <i :class="iconClass"></i>
      </button>
    </div>
  </li>
</template>

<script setup lang="ts">
defineProps<{
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