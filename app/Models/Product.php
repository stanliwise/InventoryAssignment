<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
