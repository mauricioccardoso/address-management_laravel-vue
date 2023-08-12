<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Http\Requests\StoreAddressRequest;
use App\Services\AddressService;
use Exception;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function __construct(
        protected AddressService $addressService
    ) {
    }

    public function store(StoreAddressRequest $request)
    {
        DB::beginTransaction();
        $data = $request->all();

        try {
            $address = $this->addressService->store($data);

            DB::commit();

            return response()->json($address, 201);
        } catch (Exception $e) {
            DB::rollBack();

            $error = 'Unable to create a new address.';
            Logger::log($e, $error);

            return response()->json(["error" => $error], 500);
        }
    }
}
