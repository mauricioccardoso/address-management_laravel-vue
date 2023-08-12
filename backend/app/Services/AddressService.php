<?php

namespace App\Services;

use App\Models\Address;

class AddressService
{
    public function store($data): Address
    {
        return Address::create($data);
    }
}
