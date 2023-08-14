import axios from "axios";

export const apiViaCep = async (urlComplement: string) => {
  const url = `https://viacep.com.br/ws/${urlComplement}/json/`;

  try {
    const response = await axios.get(url);
    return response.data;

  } catch (error) {
    console.error('Erro ao buscar o CEP', error);
  }
}