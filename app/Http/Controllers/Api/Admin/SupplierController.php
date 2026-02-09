<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Supplier\SupplierService;
use App\Services\Admin\Bank\BankService;
use App\Http\Resources\Admin\Supplier\SupplierListResource;
use App\Http\Resources\Admin\Bank\BankListResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierController extends Controller
{
    public function __construct(
        private SupplierService $service,
        private BankService $bankService
    ) {}

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

    // --- Banks (CRUD within SupplierController) ---
    public function bankIndex(Request $request)
    {
        $banks = $this->bankService->getAll($request->all());
        return BankListResource::collection($banks);
    }

    public function bankShow(int $id)
    {
        try {
            $bank = $this->bankService->getDetail($id);
            return new BankListResource($bank);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('Data not found', 404);
        }
    }

    public function bankStoreOrUpdate(Request $request)
    {
        $bank = $this->bankService->save($request->all());
        return new BankListResource($bank);
    }
}
