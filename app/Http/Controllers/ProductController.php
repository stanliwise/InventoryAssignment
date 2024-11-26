<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:is_admin', except: ['index', 'show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric|gt:0',
            'title' => 'required|string',
            'description' => 'required|string',
            'product_category_id' => 'required|exists:product_categories'
        ]);

        return Product::create([
            'price' => $request->price,
            'title' => $request->title,
            'description' => $request->description,
            'product_category_id' => $request->product_category_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return (new ProductResource($product))->resolve();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'price' => 'nullable|numeric|gt:0',
            'title' => 'nullable|required|string',
            'description' => 'nullable|required|string',
            'product_category_id' => 'nullable|exists:product_categories,id'
        ]);

        // Filter out null values from the validated data
        $filteredData = collect($validated)->filter(function ($value) {
            return !is_null($value);
        })->toArray();

        $product->update($filteredData);

        return (new ProductResource($product))->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $title = $product->title;
        return $product->delete();
    }
}
