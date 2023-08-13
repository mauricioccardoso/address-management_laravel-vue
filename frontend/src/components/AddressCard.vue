<template>
  <div class="card h-100">
    <div class="card-body d-flex flex-column justify-content-between">
      <div class="mb-3">
        <h5 class="card-title">{{ street }}</h5>
        <p class="card-text">{{ neineighborhood }}, {{ city }} - {{ state }}, {{ cep }}</p>
      </div>
      <div class="d-flex justify-content-evenly">
        <button class="btn btn-primary fs-6">
          Editar
          <i class="bi bi-pencil-fill fs-"></i>
        </button>
        <button class="btn btn-danger">
          Excluir
          <i class="bi bi-trash2-fill"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  cep: String
  street: String,
  neineighborhood: String,
  city: String,
  state: String,
}>();
</script>