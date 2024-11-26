<?php

use App\Models\ProductCategory;
use App\Models\User;

test('product category creation works expect', function () {
    $user = User::factory(['is_admin' => true, 'discount_value' => 3])->create();

    $this->actingAs($user)->postJson(route('productCategory.store'), [
        'name' => 'hello',
        'discount_value' => 24
    ])->assertOk();
});

test('product category deletion works expect', function () {
    $user = User::factory(['is_admin' => true, 'discount_value' => 3])->create();
    $product_cat =     ProductCategory::factory()->create();
    $this->actingAs($user)->deleteJson(route('productCategory.destroy', ['productCategory' => $product_cat->id]))->assertOk();
    
});

test('product category update works as expected', function () {
    $user = User::factory(['is_admin' => true, 'discount_value' => 3])->create();
    $product_cat =     ProductCategory::factory()->create([ 'name' => 'categ']);

    $this->actingAs($user)->patchJson(route('productCategory.update', ['productCategory' => $product_cat->id]), [
        'name' => 'categ2'
    ])->assertOk();

    $this->assertDatabaseHas('product_categories', ['name' => 'categ2']);
});
