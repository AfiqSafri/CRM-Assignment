<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . ($this->customer ? $this->customer->id : ''),
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'avatar' => 'nullable|image',
            'id_number' => 'required|string|max:50|unique:customers,id_number,' . ($this->customer ? $this->customer->id : ''),
        ];
    }
}
