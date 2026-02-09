<?php

namespace App\Http\Requests\Admin\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreAndUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id=$this->input('id');
        return [
            'name' => 'required|string|max:255',
            'supplier_code' => 'required|unique:suppliers,supplier_code,'.$id,
            'phone_number' => 'required|unique:suppliers,phone_number,'.$id,
            'email' => 'required|email|max:255|unique:suppliers,email,'.$id,
            'address' => 'required',
            'bank_id' => 'required|exists:banks,id',
            'bank_account_no' => 'required|string|max:255|unique:suppliers,bank_account_no,'.$id,
            'credit_limit_amount' => 'required|numeric',
            'is_active' => 'required|boolean',
        ];
    }
}
