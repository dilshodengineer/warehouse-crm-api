<?php

namespace App\Services;

use App\Models\User;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleService{
    public function createSale(array $data, User $user) : Sale {
        return DB::transaction(function () use ($data, $user) {
            $sale = Sale::create([
                'user_id' => $user->id,
                'total_amount' => 0,
                'paid_amount' => $data['paid_amount'] ?? 0,
                'discount' => $data['discount'] ?? 0,
                'payment_status' => 'unpaid',
            ]);

            return $sale;   
        });

    }
}