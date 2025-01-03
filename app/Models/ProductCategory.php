<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $guarded = [];

    /** @use HasFactory<\Database\Factories\ProductCategoryFactory> */
    use HasFactory;

    protected $fillable =['name', 'discount_value'];
    protected $casts = [
        'discount_value' => 'float'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
