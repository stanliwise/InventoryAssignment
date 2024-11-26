<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

class ProductCategoryController extends Controller implements HasMiddleware
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
        return Inertia::render('Admin/Categories/CategoryList', [
            'categories' => ProductCategory::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Categories/CreateCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:product_categories,name',
            'discount_value' => 'nullable|numeric|min:0|max:100',
        ]);

        ProductCategory::create([
            'name' => $request->name,
            'discount_value' => $request->discount_value
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        return $productCategory;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory) {
        return Inertia::render('Admin/Categories/EditCategory', [
            'category' => $productCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|min:2',
            'discount_value' => 'nullable|numeric|min:0|max:100',
        ]);


        // Filter out null values from the validated data
        $filteredData = collect($validated)->filter(function ($value) {
            return !is_null($value);
        })->toArray();

        $productCategory->update($filteredData);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $name = $productCategory->name;
        $productCategory->delete();
    }
}
