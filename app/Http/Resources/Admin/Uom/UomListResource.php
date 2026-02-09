<?php

namespace App\Http\Resources\Admin\Uom;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UomListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'uom_code'      => $this->uom_code,
            'name'      => $this->name,
            'is_active' => $this->is_active,
        ];
    }
}
