<?php

namespace App\Http\Resources\Admin\InventoryLedger;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryLedgerListResource extends JsonResource
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
            'inventory' => [
                'id' => $this->inventory?->id,
                'name' => $this->inventory?->name,
            ],
            'transaction_type' => $this->transaction_type,
            'transaction_id' => $this->transaction_id,
            'reference_no' => $this->reference_no,
            'date' => optional($this->date)->format('Y-m-d'),
            'remarks' => $this->remarks,
            'inventory_ledger_items' => InventoryLedgerItemListResource::collection($this->whenLoaded('inventory_ledger_items')),
            'created_at' => optional($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
