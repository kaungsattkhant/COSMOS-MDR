<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Supplier\SupplierService;
use App\Http\Resources\Admin\Supplier\SupplierListResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierController extends Controller
{
    private $service;
    public function __construct(SupplierService $service) {
        $this->service=$service;
    }

    // --- Suppliers ---
    public function index(Request $request)
    {
        $suppliers = $this->service->getAllSuppliers($request->all());
        return SupplierListResource::collection($suppliers);
    }

    public function show(int $id)
    {
        try {
            $supplier = $this->service->getSupplierDetail($id);
            return new SupplierListResource($supplier);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('Data not found', 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $supplier = $this->service->saveSupplier($request->all());
        return new SupplierListResource($supplier);
    }

}
