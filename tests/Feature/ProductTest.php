<?php

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

uses(RefreshDatabase::class);
uses(WithFaker::class);

test('product creation works', function () {
    $user = User::factory(['is_admin' => true, 'discount_value' => 3])->create();
    ProductCategory::factory()->create();
    $this->actingAs($user)->postJson(route('admin.products.store'), [
        'title' => $this->faker->word,
        'price' => 20,
        'description' => $this->faker->sentence,
        'product_category_id' => ProductCategory::first()->id,
    ])->assertRedirect();

    $this->assertDatabaseCount('products', 1);
});

test('product updating works', function () {
    $user = User::factory(['is_admin' => true, 'discount_value' => 3])->create();
    $category = ProductCategory::factory()->create();
    $product = Product::factory()->create(['product_category_id' => $category->id]);

    $this->actingAs($user)->patchJson(route('admin.products.update', ['product' => $product->id]), [
        'title' => 'Caprison'
    ])->assertRedirect();

    $this->assertDatabaseHas('products', ['title' => 'Caprison']);
});

test('product deletion works', function () {
    $user = User::factory(['is_admin' => true, 'discount_value' => 3])->create();
    $category = ProductCategory::factory()->create();
    $product = Product::factory()->create(['product_category_id' => $category->id]);

    $this->actingAs($user)->deleteJson(route('admin.products.update', ['product' => $product->id]), [
        'title' => 'Caprison'
    ])->assertOk();

    $this->assertDatabaseCount('products', 0);
});


test('product sales price and cost price', function(){
    //ProductCategory::create([])
   // $this->postJson(route('admin.customer.index'));
});