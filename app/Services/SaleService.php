<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Support\Price;

class SaleService
{
    public function createSale(array $data, User $user): Sale
    {
        return DB::transaction(function () use ($data, $user) {

            $paid = Price::parse($data['paid_amount'] ?? 0);
            $discount = Price::parse($data['discount'] ?? 0);

            $items = $data['items'] ?? [];

            if (count($items) < 1) {
                throw ValidationException::withMessages([
                    'items' => "Kamida bitta mahsulot bo'lishi shart"
                ]);
            }


            $productsMap = [];

            foreach ($items as $item) {

                $productId = $item['product_id'];
                $quantity = (float) $item['quantity'];

                $product = Product::lockForUpdate()->find($productId);

                if (!$product) {
                    throw ValidationException::withMessages([
                        'product_id' => "Product topilmadi (ID: $productId)"
                    ]);
                }

                if ($quantity < 1) {
                    throw ValidationException::withMessages([
                        'quantity' => "Quantity kamida 1 bo'lishi kerak"
                    ]);
                }

                if ($product->stock !== null && $product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'stock' => "{$product->name} uchun yetarli mahsulot yo'q (Mavjud: {$product->stock})"
                    ]);
                }

                $productsMap[$productId] = $product;
            }



            $sale = Sale::create([
                'user_id' => $user->id,
                'customer' => $data['customer'] ?? null,
                'phone' => $data['phone'] ?? null,
                'total_amount' => 0,
                'paid_amount' => $paid,
                'discount' => $discount,
                'payment_status' => 'unpaid',
            ]);

            $totalAmount = 0;



            foreach ($items as $item) {

                $product = $productsMap[$item['product_id']];
                $quantity = (float) $item['quantity'];

                $price = (int) $product->price;
                $subtotal = $price * $quantity;

                $totalAmount += $subtotal;

                $sale->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku ?? null,
                    'unit' => $item['unit'],
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);


                if ($product->stock !== null) {
                    $product->decrement('stock', $quantity);
                }
            }



            $discount = (int) ($data['discount'] ?? 0);
            $totalAfterDiscount = max(0, $totalAmount - $discount);

            $status = match (true) {
                $paid >= $totalAfterDiscount => 'paid',
                $paid > 0 => 'partial',
                default => 'unpaid',
            };



            $sale->update([
                'total_amount' => $totalAfterDiscount,
                'payment_status' => $status,
            ]);

            return $sale->load('items');
        });
    }
}
