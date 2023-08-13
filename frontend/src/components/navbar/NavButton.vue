<template>
  <li class="nav-item">
    <div class="nav-link">
      <button type="button" :class="btnClass">
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