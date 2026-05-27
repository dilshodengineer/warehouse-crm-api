<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
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
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
