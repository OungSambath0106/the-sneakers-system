<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_type',
        'order_amount',
        'discount_amount',
        'delivery_type',
        'delivery_fee',
        'payment_method',
        'address',
        'pay_slip',
    ];

    protected $casts = [
        'address' => 'array'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
