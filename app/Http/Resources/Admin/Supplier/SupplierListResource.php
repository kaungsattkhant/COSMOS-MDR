<?php

namespace App\Http\Resources\Admin\Supplier;

use App\Http\Resources\Admin\Bank\BankListResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'supplier_code'       => $this->supplier_code,
            'phone_number'        => $this->phone_number,
            'email'               => $this->email,
            'address'             => $this->address,
            'bank_id'             => $this->bank_id,
            'bank'                => $this->whenLoaded('bank', fn () => new BankListResource($this->bank)),
            'bank_account_no'     => $this->bank_account_no,
            'credit_limit_amount' => $this->credit_limit_amount,
            'is_active'           => $this->is_active,
        ];
    }
}
