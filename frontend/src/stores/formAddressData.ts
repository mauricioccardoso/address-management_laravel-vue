import { ref, type Ref } from 'vue'
import { defineStore } from 'pinia'
import type { addressDataDTO } from '@/DTOs/adddressDataDTO';



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

  function deleteAddressModal(data: addressDataDTO) {
    addressData.value = data
  }

  return { addressData, titleModal, openModal, clearForm, deleteAddressModal }
})
