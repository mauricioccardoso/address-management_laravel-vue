import { defineStore } from 'pinia'
import httpClient from '@/http';
import Swal from 'sweetalert2';
import { ref, type Ref } from 'vue';

interface IAddressData {
  id: number,
  cep: string,
  street: string,
  neighborhood: string,
  city: string,
  state: string,
}

export const useAddressListStore = defineStore('addressListStore', () => {
  const addressList: Ref<IAddressData[]> = ref([])

  async function listAddress() {
    httpClient.get('/addresses')
      .then(({ data }) => {
        addressList.value = data;

        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Lista de endereços atualizada.',
          showConfirmButton: false,
          timer: 1500
        })
      })
      .catch(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Não foi possível carregar a lista de endereços',
          showConfirmButton: false,
          timer: 1500
        })
      });
  }

  return { addressList, listAddress }
})
