import { defineStore } from 'pinia'
import httpClient from '@/http';
import Swal from 'sweetalert2';
import { ref, type Ref } from 'vue';
import type { addressDataDTO } from '@/DTOs/adddressDataDTO';

interface IAddressData {
  id: number,
  cep: string,
  street: string,
  neighborhood: string,
  city: string,
  state: string,
}

interface ISearchData {
  cep?: string
  street?: string,
  neighborhood?: string,
  city?: string,
  state?: string,
}

export const useAddressStore = defineStore('addressListStore', () => {
  const addressesList: Ref<IAddressData[]> = ref([]);

  const addressesSearch: Ref<IAddressData[]> = ref([]);

  async function listAddress() {
    httpClient.get('/addresses')
      .then(({ data }) => {
        addressesList.value = data;

        setTimeout(() => {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Lista de endereços atualizada.',
            showConfirmButton: false,
            timer: 1500
          })
        }, 1500);
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

  async function save(data: addressDataDTO) {
    httpClient.post('/addresses', data)
      .then(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Endereço salvo com sucesso.',
          showConfirmButton: false,
          timer: 1500
        })

        listAddress();
      })
      .catch(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Não foi possível salvar o endereço.',
          showConfirmButton: false,
          timer: 1500
        })
      });

  }

  async function update(data: addressDataDTO) {
    httpClient.put(`/addresses/${data.id}`, data)
      .then(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Endereço atualizado com sucesso.',
          showConfirmButton: false,
          timer: 1500
        })

        listAddress();
        addressesSearch.value = [];
      })
      .catch(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Não foi possível atualizar o endereço.',
          showConfirmButton: false,
          timer: 1500
        })
      });
  }

  async function deleteAddress(id: number) {
    httpClient.delete(`/addresses/${id}`)
      .then(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Endereço excluído com sucesso.',
          showConfirmButton: false,
          timer: 1500
        })

        listAddress();
        addressesSearch.value = [];
      })
      .catch(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Não foi possível excluír o endereço.',
          showConfirmButton: false,
          timer: 1500
        })
      });

  }

  async function search(data: ISearchData) {
    httpClient.post('/addresses/search', data)
      .then(({ data }) => {

        if (data?.errors) {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'CEP ou Endereço incorreto ou não existe.',
            showConfirmButton: false,
            timer: 1500
          })
          return;
        }

        if (data.id) {
          addressesSearch.value = [];
          addressesSearch.value.push(data);
        } else {
          addressesSearch.value = data;
        }

        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Endereço encontrado.',
          showConfirmButton: false,
          timer: 1500
        })

        listAddress();
      })
      .catch(() => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Não foi possível buscar o endereço.',
          showConfirmButton: false,
          timer: 1500
        })
      });

  }

  return { addressesList, addressesSearch, listAddress, save, update, deleteAddress, search }
})
