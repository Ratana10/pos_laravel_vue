<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
    
     
    //In this code block, the phone field has been modified to include an additional validation rule 
    //that checks for uniqueness in the customers table but excludes the current record being updated.
    // This is done by appending ,$this->id to the unique rule. The $this->id value should contain the ID of the record being updated.
    //            'phone' => 'nullable|unique:customers,phone,'.$this->id,

    // cannot use this request
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'gender' => 'required',
            'phone' => 'nullable|unique:customers,phone,',
            'address' => 'nullable|max:255',
        ];
    }

}