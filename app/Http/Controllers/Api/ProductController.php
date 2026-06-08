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
            'success' => true,
            'message' => 'Mahsulot muvaffaqiyatli qo`shildi.',
            'data' => $product,

        ], 201);
            
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Siz tanlagan mahsulotingiz.',
            'data' => $product,
        ]);
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->update(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Mahsulot muvaffaqiyatli yangilandi.',
            'data' => $product
        ]);
    }

    public function destroy(string $id)
    {

        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => "Mahsulot muvaffaqiyatli o'chirildi"
        ], 200);
        
    }
}
