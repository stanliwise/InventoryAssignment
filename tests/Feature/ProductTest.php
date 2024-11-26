<?php

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

uses(RefreshDatabase::class);
uses(WithFaker::class);

test('product index works', function(){
    User::factory(['is_admin' => true])->create();
    ProductCategory::factory()->create();
    $this->postJson(route('product.store'), [
        'title' => $this->faker->word,
        'description' => $this->faker->sentence,
        'product_category_id' => ProductCategory::first()->id,
    ])->dump();
});