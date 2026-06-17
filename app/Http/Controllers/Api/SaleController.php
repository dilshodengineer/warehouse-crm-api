<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleRequest;
use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sale::with('items', 'user')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => "Sales have been got successfuly.",
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $sale = $this->saleService->createSale(
            $request->validated(),
            $request->user()
        );

        return response()->json([
            'success' => true,
            'message' => "Savdo muvaffaqiyatli qo'shildi",
            'data' => $sale->load('items', 'user'),
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
