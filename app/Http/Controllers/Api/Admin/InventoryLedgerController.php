<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\Admin\InventoryLedger\InventoryLedgerService;
use App\Http\Resources\Admin\InventoryLedger\InventoryLedgerListResource;

class InventoryLedgerController extends Controller
{
    public function __construct(
        private InventoryLedgerService $service
    ) {}

    public function index(Request $request)
    {
        $ledgers = $this->service->getAll($request->all());
        return InventoryLedgerListResource::collection($ledgers);
    }

    public function show(int $id)
    {
        try {
            $ledger = $this->service->getDetail($id);
            return new InventoryLedgerListResource($ledger);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('Data not found', 404);
        }
    }
}