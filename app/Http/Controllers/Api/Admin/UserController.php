<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\User\UserService;
use App\Http\Resources\Admin\User\UserResource;
use App\Http\Requests\Admin\User\UserStoreRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        $users = $this->service->getAll($request->all());
        return UserResource::collection($users);
    }
    public function show(int $userId)
    {
        try {
            $user = $this->service->getDetail($userId);
            return new UserResource($user);
        } catch (ModelNotFoundException $e) {
            return ResponseMessage('User not found', 404);
        }
    }

    public function storeOrUpdate(UserStoreRequest $request)
    {
        $user = $this->service->save($request->all());
        return new UserResource($user);
    }
}
