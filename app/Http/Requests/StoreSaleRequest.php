<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreSaleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],

            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],

            'paid_amount' => ['nullable', 'integer', 'min:0'],
            'discount' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages() : array
    {
        return [
            'items.required' => "Kamida bitta mahsulot bo'lishi shart",
            'items.array' => "Items array bo'lishi kerak",
            'items.*.product_id.required' => 'Product tanlanmagan',
            'items.*.product_id.exists' => 'Bunday product mavjud emas',
            'items.*.quantity.min' => "Quantity kamida 1 bo'lishi kerak",
        ];
    }
}