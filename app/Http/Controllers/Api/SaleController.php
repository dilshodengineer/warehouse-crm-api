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

    
    public function index()
    {
        $data = Sale::with('items', 'user')->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => "Sales have been got successfuly.",
            'data' => $data
        ]);
    }

    
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

    
    public function show(string $id)
    {
        $sale = Sale::with(['items', 'user'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Savdo tarixi va retsepti muvaffaqiyatli oldi.',
            'data' => $sale
        ]);
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
