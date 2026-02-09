<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Customer\CustomerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Admin\Customer\CustomerListResource;

class CustomerController extends Controller
{
    //
    private $service;

    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $users = $this->service->getAllCustomer($request->all());
        return CustomerListResource::collection($users);
    }
    public function show(int $userId)
    {
        try {
            $user = $this->service->getCustomerDetail($userId);
            return new CustomerListResource($user);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('User not found', 404);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|unique:customers,phone_number',
        ]);
        $user = $this->service->saveCustomer($request->all());
        return new CustomerListResource($user);
    }
}
