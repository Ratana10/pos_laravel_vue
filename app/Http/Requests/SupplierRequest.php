<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:15',
            'gender' => 'required',
            'phone' => 'nullable|unique:supplier, phone,'.$this->id,
            'facebook' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'status' => 'required',
        ];
    }
}