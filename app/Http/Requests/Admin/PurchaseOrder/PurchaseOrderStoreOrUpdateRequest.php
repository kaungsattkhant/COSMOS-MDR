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
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'po_invoice_no'=>'required|unique:purchase_orders,po_invoice_no',
            'po_date'=> 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount'=>'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_order_items'       => 'required|array',
            'purchase_order_items.*.item_id' => 'required|exists:items,id',
            'purchase_order_items.*.qty'     => 'required|numeric|min:1',
            'purchase_order_items.*.price'   => 'required|numeric|min:0',
        ];
    }
}