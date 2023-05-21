<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => 'required|string',
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'quantity' => 'required|numeric',
            'alert' => 'required|numeric',
            'image' => 'nullable',
            'barcode' => 'nullable|string',
            'status' => 'required',
        ];
    }
}