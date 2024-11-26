<?php

namespace App\Models;

use App\Concerns\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFilter;

    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $filterable = [
        'category_id'
    ];

    protected $fillable = [
        'title',
        'description',
        'price',
        'product_category_id'
    ];

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
