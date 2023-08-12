<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

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
}
