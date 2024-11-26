<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Categories/CategoryList', [
            'categories' => ProductCategory::paginate(20)
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/CreateCategory');
    }

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

    public function edit(ProductCategory $category) {
        return Inertia::render('Admin/Categories/EditCategory', [
            'category' => $category
        ]);
    }

    public function update(Request $request, ProductCategory $category)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|min:2',
            'discount_value' => 'nullable|numeric|min:0|max:100',
        ]);


        // Filter out null values from the validated data
        $filteredData = collect($validated)->filter(function ($value) {
            return !is_null($value);
        })->toArray();

        $category->update($filteredData);

        return redirect()->route('admin.categories.index');
    }

    public function destroy(ProductCategory $category)
    {
        $name = $category->name;
        $category->delete();
    }
}
