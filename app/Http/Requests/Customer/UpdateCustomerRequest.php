<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
        $route_parameters = $this->route()->parameters();

        return [
            'name' => ['required', 'string', 'max:255', 'unique:customers,mobile,' . $route_parameters['customer_id']],
            'mobile' => ['required', 'string', 'max:20', 'regex:/^(?:\+94|0)?7\d{8}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
        ];
    }
}
