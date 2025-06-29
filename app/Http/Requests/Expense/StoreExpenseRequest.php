<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'expense_category_id' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:1', 'max:100000000000'],
            'file' => ['nullable', 'max:5120'],
            'note' => ['nullable', 'string', 'max:255'],
        ];
    }

    function messages()
    {
        return [
            'expense_category_id.required' => 'Expense category is required',
            'expense_category_id.numeric' => 'Expense category is required',
            'date.required' => 'Date is required',
            'date.date' => 'Date must be a valid date',
            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Amount must be a numeric value',
            'amount.min' => 'Amount must be greater than or equal to 1',
            'amount.max' => 'The amount must be less than 100,000,000,000',
            'file.nullable' => 'File is optional',
            'file.max' => 'File must be less than 5MB',
            'note.nullable' => 'Note is optional',
            'note.string' => 'Note must be a string',
            'note.max' => 'Note must not exceed 255 characters',
        ];
    }
}
