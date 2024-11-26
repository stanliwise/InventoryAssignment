<?php

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

uses(RefreshDatabase::class);
uses(WithFaker::class);

test('product index works', function(){
   $user = User::factory(['is_admin' => true, 'discount_value' => 3])->create();
    ProductCategory::factory()->create();
    $this->actingAs($user)->postJson(route('product.store'), [
        'title' => $this->faker->word,
        'price' => 20,
        'description' => $this->faker->sentence,
        'product_category_id' => ProductCategory::first()->id,
    ])->assertOk();
});

test('product updating works', function(){
});