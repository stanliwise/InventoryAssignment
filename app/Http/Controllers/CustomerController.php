<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class CustomerController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('can:is-admin', except: ['index', 'show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Customers/CustomerList', [
            'customers' => User::where('is_admin', false)->paginate(20)
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Customers/AddCustomer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'password' => 'required|confirmed|min:8|max:32',
            'email' =>  'unique:users,email',
            'discount_value' => 'nullable|numeric|gte:0',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'discount_value' => $request->discount_value,
        ]);

        return redirect()->route('admin.customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $customer)
    {
        return Inertia::render('Admin/Customers/EditCustomer', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $customer)
    {
        $data = $request->validate([
            'name' => 'nullable|string|min:2|max:255',
            'password' => 'nullable|confirmed',
            'email' =>  'nullable|unique:users,email,' . $customer->id,
            'discount_value' => 'nullable|numeric|gte:0',
        ]);

        $filtered = collect($data)->filter(
            fn ($datum) => !is_null($datum)
        );

        $customer->update($filtered->toArray());

        return redirect()->route('admin.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $id) {}
}
