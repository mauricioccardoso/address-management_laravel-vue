<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class APIViaCEP
{
    public function search($urlComplement)
    {
        $viaCEPResponse = Http::get("https://viacep.com.br/ws/{$urlComplement}/json/");

        if (!$viaCEPResponse->successful()) {
            return ['errors' => 'Unable to search the address. Please try again later.'];
        }

        $response = $viaCEPResponse->json();

        if (isset($response['erro']) || empty($response)) {
            return ['errors' => 'The provided CEP or Address is incorrect or does not exist.'];
        }

        return $response;
    }

    public function searchByAddressOrCEP($addressData)
    {
        if (isset($addressData['cep'])) {
            $urlComplement = str_replace('-', '', $addressData['cep']);
        }

        if (isset($addressData['street'])) {
            $urlComplement =  $addressData['state'] . '/' . $addressData['city'] . '/' . $addressData['street'];
        }

        return $this->search($urlComplement);
    }
}
