<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the brand associated with the transaction.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the product associated with the transaction.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
