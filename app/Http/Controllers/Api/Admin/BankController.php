<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Bank\BankService;
use App\Http\Resources\Admin\Bank\BankListResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BankController extends Controller
{
    //
     private $service;

    public function __construct(BankService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $banks = $this->service->getAllBanks($request->all());
        return BankListResource::collection($banks);
    }

    public function show(int $id)
    {
        try {
            $bank = $this->service->getDetail($id);
            return new BankListResource($bank);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('Data not found', 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $bank = $this->service->saveBank($request->all());
        return new BankListResource($bank);
    }
}
