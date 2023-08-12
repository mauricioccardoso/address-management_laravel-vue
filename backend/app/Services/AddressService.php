<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class AddressService
{
    /**
     * @return Collection<int, Address>
     */
    public function listAll(): Collection
    {
        return Address::all();
    }

    public function store($data): Address
    {
        return Address::create($data);
    }

    public function update($data, $address): bool
    {
        return $address->update($data);
    }

    public function delete($address): bool
    {
        return $address->delete();
    }

    /**
     * @return Collection<int, Address>
     */
    public function findByAddress($addressData): Collection
    {
        $address = Address::query()
            ->when(isset($addressData['cep']), function ($query) use ($addressData) {
                return $query->where('cep', $addressData['cep']);
            })

            ->when(isset($addressData['street']), function ($query) use ($addressData) {
                return $query->where('street', 'LIKE', '%' . $addressData['street'] . '%');
            })
            ->when(isset($addressData['city']), function ($query) use ($addressData) {
                return $query->where('city', 'LIKE', '%' . $addressData['city'] . '%');
            })
            ->when(isset($addressData['state']), function ($query) use ($addressData) {
                return $query->where('state', $addressData['state']);
            })
            ->when(isset($addressData['neighborhood']), function ($query) use ($addressData) {
                return $query->where('neighborhood', 'LIKE', '%' . $addressData['neighborhood'] . '%');
            });

        return $address->get();
    }

    public function createAddressFromViaCEP($addressSearch, $dataViaCEP)
    {
        if (isset($addressSearch['street'])) {
            // Remove accents e uppercase words from search address
            $street = ucwords(Str::ascii($addressSearch['street']));
            $neighborhood = ucwords(
                $addressSearch['neighborhood'] ? Str::ascii($addressSearch['neighborhood']) : null
            );

            // Filter address by street and neighborhood
            $address = array_filter($dataViaCEP, function ($item) use ($street, $neighborhood) {
                // Remove accents
                $itemStreet = Str::ascii($item['logradouro']);
                $itemNeighborhood = Str::ascii($item['bairro']);

                return str_contains($itemStreet, $street) && ($neighborhood === null || str_contains($itemNeighborhood, $neighborhood));
            });

            if (empty($address)) {
                return ['errors' => 'The provided CEP or Address is incorrect or does not exist.'];
            }

            $dataViaCEP = reset($address);
        }

        $data = [
            'cep' => $dataViaCEP['cep'],
            'street' => $dataViaCEP['logradouro'],
            'neighborhood' => $dataViaCEP['bairro'],
            'city' => $dataViaCEP['localidade'],
            'state' => $dataViaCEP['uf'],
        ];

        return $this->store($data);
    }
}
