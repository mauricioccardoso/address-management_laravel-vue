import { ref, type Ref } from 'vue'
import { defineStore } from 'pinia'

interface addressDataDTO {
  id: number | null,
  cep: string | null,
  street: string | null,
  neighborhood: string | null,
  city: string | null,
  state: string | null,
}

export const useformAddressData = defineStore('formAddressData', () => {
  const addressData: Ref<addressDataDTO> = ref({
    id: null,
    cep: null,
    street: null,
    neighborhood: null,
    city: null,
    state: null,
  });
  const titleModal = ref('');

  function openModal(title: string, data: addressDataDTO) {
    addressData.value = data
    titleModal.value = title;
  }

  function clearForm() {
    titleModal.value = '';
  }

  return { addressData, titleModal, openModal, clearForm }
})
