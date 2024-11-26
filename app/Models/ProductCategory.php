<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use HasFactory;

    protected $fillable =['title', 'discount_value'];
    protected $casts = [
        'discount_value' => 'float'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
