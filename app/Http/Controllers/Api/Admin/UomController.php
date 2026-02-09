<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Uom\UomService;
use App\Http\Resources\Admin\Uom\UomListResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UomController extends Controller
{
    private $service;

    public function __construct(UomService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $uoms = $this->service->getAll($request->all());
        return UomListResource::collection($uoms);
    }

    public function show(int $id)
    {
        try {
            $uom = $this->service->getDetail($id);
            return new UomListResource($uom);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('Data not found', 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $uom = $this->service->save($request->all());
        return new UomListResource($uom);
    }
}
