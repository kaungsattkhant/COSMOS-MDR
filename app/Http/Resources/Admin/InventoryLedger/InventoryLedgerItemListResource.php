<?php

namespace App\Http\Resources\Admin\InventoryLedger;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryLedgerItemListResource extends JsonResource
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
            'item' => [
                'id' => $this->item?->id,
                'name' => $this->item?->name,
                'code' => $this->item?->code,
            ],
            'quantity' => $this->quantity,
        ];
    }
}
