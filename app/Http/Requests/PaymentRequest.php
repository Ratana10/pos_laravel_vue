<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'sale_code' => 'required|string',
            'sale_id' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'change' => 'nullable|numeric',
            'payment_method' => 'required|numeric',
        ];
    }
}