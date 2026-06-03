<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',

            'price' => 'required|numeric|min:100',

            'stock' => [
                'required', 
                'numeric',
                'min:0.5',
                function ($attribute, $value, $fail){
                    if (
                        $this->unit === 'pcs' &&
                        floor($value) != $value
                    ){
                        $fail("Donali maxsulot uchun miqdor butun son bo'lishi kerak");
                    }
                }
                ],

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

            // price
            'price.required' => 'Narxni kiriting.',
            'price.numeric'  => 'Narx raqam bo`lishi kerak.',
            'price.min'      => 'Narx kamida :min bo`lishi kerak.',

            // stock
            'stock.required' => 'Iltimos mahsulot miqdorini kiriting.',
            'stock.numeric'  => 'Miqdor raqam bo`lishi kerak.',
            'stock.min'      => "Miqdor kamida :min dan katta bo'lishi kerak.",

            // unit
            'unit.required' => 'Iltimos mahsulot o`lchov turini tanlang.',
            'unit.in'       => 'O`lchov turi faqat kg, l yoki dona bo`lishi mumkin.',
        ];
    }
}