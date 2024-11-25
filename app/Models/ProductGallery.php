<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['images_url'];
    protected $casts = [
        'images' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getImagesUrlAttribute()
    {
        $basePath = asset('uploads/products');
        if (is_array($this->images) && !empty($this->images)) {
            return array_map(function ($images) use ($basePath) {
                return $basePath . '/' . $images;
            }, $this->images);
        }
        // return [asset('uploads/images/default-room.png')];
        return [];
    }
}
