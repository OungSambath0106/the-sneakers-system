<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_amount',
        'discount_amount',
        'discount_type',
        'shipping_method',
        'shipping_address',
        'shipping_fee',
        'order_status',
        'order_note',
        'payment_status',
        'payment_method',
        'payment_image',
        'latitude',
        'longitude',
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
