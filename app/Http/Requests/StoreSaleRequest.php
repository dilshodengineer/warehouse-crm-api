<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit' => ['required', 'in:pcs,l,kg'],

            'paid_amount' => ['nullable', 'integer', 'min:0'],
            'discount' => ['nullable', 'integer', 'min:0'],

            'customer' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'string', 'min:9', 'max:20'],
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
            'customer.required' => "Mujoz isminiham kiriting.",
            'customer.min' => "Mijoz ismi kamida :min ta harf yoki belgidan iborat bo'lishi kerak",
            'phone.required' => "Mijozning telefom raqami ham talab qilinadi"
        ];
    }
}
