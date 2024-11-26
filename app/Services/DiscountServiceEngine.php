<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;

class DiscountServiceEngine
{
    public static function getSalesPrice(Product $product, ?User $user = null)
    {
        $product_price = $product->price;

        if ($user && ($user_discount = $user?->discount_value)) {
            $product_price -= static::getDiscountedPrice($product, $user_discount);
        }

        if ($product_discount = $product->category?->discount_value) {
            $product_price -= static::getDiscountedPrice($product, $product_discount);
        }


        return $product_price;
    }

    protected static function getDiscountedPrice(Product $product, ?int $discount_value)
    {
        $discounted_price = 0;

        if ($discount_value) {
            $discounted_price = $product->price * ($discount_value / 100);
        }

        return $discounted_price;
    }
}
