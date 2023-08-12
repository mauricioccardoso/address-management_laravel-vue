<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Http\Requests\SearchAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Services\AddressService;
use App\Services\APIViaCEP;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function __construct(
        protected AddressService $addressService,
        protected APIViaCEP $apiViaCEP
    ) {
    }

    public function listAll(): JsonResponse
    {
        try {
            $addresses = $this->addressService->listAll();

            return response()->json($addresses);
        } catch (Exception $e) {
            $error = 'Unable to load the list of all address.';
            Logger::log($e, $error);

            return response()->json(["error" => $error], 500);
        }
    }

    public function store(StoreAddressRequest $request): JsonResponse
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

    public function update(UpdateAddressRequest $request, Address $address): JsonResponse
    {
        DB::beginTransaction();
        $data = $request->all();

        try {
            $this->addressService->update($data, $address);

            DB::commit();

            return response()->json(null, 204);
        } catch (Exception $e) {
            DB::rollBack();

            $error = 'Unable to update the selected address.';
            Logger::log($e, $error);

            return response()->json(['errors' => $error], 500);
        }
    }

    public function destroy(Address $address): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->addressService->delete($address);

            DB::commit();

            return response()->json(null, 204);
        } catch (Exception $e) {
            DB::rollBack();

            $error = 'Unable to delete the selected address.';
            Logger::log($e, $error);

            return response()->json(['errors' => $error], 500);
        }
    }

    public function search(SearchAddressRequest $request)
    {
        DB::beginTransaction();
        $addressSearch = $request->all();

        try {
            // Search in Database
            $addressResponse = $this->addressService->findByAddress($addressSearch);

            // Search in ViaCEP api if not found in Database
            if ($addressResponse->isEmpty()) {
                $dataViaCEP = $this->apiViaCEP->searchByAddressOrCEP($addressSearch);

                // Save new Address in Database if address found in ViaCEP API
                if (!isset($dataViaCEP['errors'])) {
                    $dataViaCEP = $this->addressService->createAddressFromViaCEP($addressSearch, $dataViaCEP);
                }

                $addressResponse = $dataViaCEP;
            }

            DB::commit();

            return response()->json($addressResponse);
        } catch (Exception $e) {
            DB::rollBack();

            $error = 'Unable to find the requested address';
            Logger::log($e, $error);

            return response()->json(['errors' => $error], 500);
        }
    }
}
