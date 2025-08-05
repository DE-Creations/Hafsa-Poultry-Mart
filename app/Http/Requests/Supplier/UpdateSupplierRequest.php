<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:suppliers,name,' . $route_parameters['supplier_id']],
            // 'nic' => ['required', 'string', 'max:12'],
            'mobile' => ['required', 'string', 'max:20', 'regex:/^(?:\+94|0)?7\d{8}$/'],
            'city' => ['required', 'string', 'max:100'],
        ];
    }
}
