<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SaleItem;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'paid_amount',
        'discount',
        'payment_status',
        'sold_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items() 
    {
        return $this->hasMany(SaleItem::class);
    }
}
