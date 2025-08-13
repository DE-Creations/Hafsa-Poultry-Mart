<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
        return [
            'invoice_number' => ['required'],
            'invoice_date' => ['required', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
            'sub_total' => ['required'],
            'discount_amount' => ['required'],
            'previous_balance_forward' => ['required'],
            'to_pay' => ['required'],
            'paid_amount' => ['required'],
            'new_balance' => ['required'],
            'items' => ['required', 'array'],

            // 'items.*.item_id' => ['required', 'exists:items,id'],
            'items.*.item_name' => ['required'],
            'items.*.description' => ['nullable', 'string'],
            'items.*.weight' => ['required', 'numeric'],
            'items.*.unit_price' => ['required', 'numeric'],
            'items.*.amount' => ['required', 'numeric'],
        ];
    }
}
