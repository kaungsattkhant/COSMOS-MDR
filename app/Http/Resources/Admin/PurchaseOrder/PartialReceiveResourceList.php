<?php

namespace App\Http\Resources\Admin\PurchaseOrder;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartialReceiveResourceList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "qty_received" => $this->qty_received,
            "status" => $this->status,
            "item" => [
                "id" => $this->item->id,
                "name" => $this->item->name,
                "uom" => $this->item->uom,
            ],
            "purchase_order" => [
                "id" => $this->purchase_order->id,
                "po_no" => $this->purchase_order->po_no,
                "po_invoice_no" => $this->purchase_order->po_invoice_no,
                "po_date" => $this->purchase_order->po_date,
            ],
            "received" => $this->received_by ? [
                "id" => $this->received->id,
                "username" => $this->received->username,
            ] : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
