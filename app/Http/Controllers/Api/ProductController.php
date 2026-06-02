<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index ()
    {
        $products = Product::latest()->paginate(10);
        return( response()->json([
            'success' => true,
            'message'=> "You got products successfuly!",
            'data' => $products
        ]));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create(
            $request->validated()
        );

        return response()->json([
            'message' => 'Mahsulot muvaffaqiyatli qo`shildi.',
            'product' => $product,

        ], 201);
        
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'message' => 'Siz tanlagan mahsulotingiz.',
            'product' => $product,
        ]);
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->update(
            $request->validated()
        );

        return response()->json([
            'message' => 'Mahsulot muvaffaqiyatli yangilandi.',
            'product' => $product
        ]);
    }

    public function destroy(string $id)
    {
        //
    }
}
