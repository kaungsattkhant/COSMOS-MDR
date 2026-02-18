<?php

namespace App\Http\Resources\Admin\User;

use App\Http\Resources\Admin\Permission\PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'type' => $this->type,
            'is_active' => $this->is_active,
            'permissions'=>PermissionResource::collection($this->permissions),
        ];
    }
}
