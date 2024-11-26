<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::IsAdmin(false)->paginate(20);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'confirmed',
            'email' =>  'unique:users,email',
            'discount_value' => 'nullable|numeric|gte:0',
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'discount_value' => $request->discount_value,
        ]);
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
    public function edit(User $user)
    {
        request()->validate([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'password' => 'nullable|confirmed',
            'email' =>  'nullable|unique:users,email',
            'discount_value' => 'nullable|numeric|gte:0',
        ]);

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $id) {}
}
