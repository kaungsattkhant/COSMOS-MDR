<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id),],
            'phone_number' => ['required', 'string', Rule::unique('users', 'phone_number')->ignore($id),],
            'username' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
