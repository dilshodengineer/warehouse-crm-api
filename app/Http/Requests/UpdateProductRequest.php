<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class UpdateProductRequest extends FormRequest
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
            'name'  => 'required|string|max:255',

            'price' => 'required|numeric|min:100',

            'stock' => 'required|numeric|min:0',

            'unit'  => 'required|in:kg,l,pcs',

            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            // name
            'name.required' => 'Mahsulot nomini kiriting.',
            'name.string'   => 'Mahsulot nomi matn bo`lishi kerak.',
            'name.max'      => 'Mahsulot nomi :max ta belgidan oshmasligi kerak.',
            'name.min'      => "Maxsulot nomi kamida :min ta belgidan ko'proq bo'lishi kerak",

            // price  `
            'price.required' => 'Narxni kiriting.',
            'price.numeric' => 'Narx raqam bo`lishi kerak.',

            // stock
            'stock.required' => 'Iltimos mahsulot miqdorini kiriting.',
            'stock.numeric' => 'Miqdor raqam bo`lishi kerak.',
            'stock.min' => 'Miqdor manfiy bo`lishi mumkin emas.',

            // unit
            'unit.required' => 'Iltimos mahsulot o`lchov turini tanlang.',
            'unit.in' => 'O`lchov turi faqat kg, l yoki dona bo`lishi mumkin.',
        ];
    }
}
