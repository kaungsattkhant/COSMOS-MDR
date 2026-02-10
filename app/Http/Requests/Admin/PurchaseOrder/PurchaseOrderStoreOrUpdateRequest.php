<?php

namespace App\Http\Requests\Admin\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderStoreOrUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'reference_no' => 'nullable|string|unique:purchase_orders,reference_no,' . ($this->id ?? 'NULL') . ',id',
            'purchase_order_items' => 'required|array|min:1',
            'purchase_order_items.*.item_id' => 'required|exists:items,id',
            'purchase_order_items.*.quantity' => 'required|numeric|gt:0',
            'purchase_order_items.*.purchase_price' => 'required|numeric|gte:0',
        ];
    }
}