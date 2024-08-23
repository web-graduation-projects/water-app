<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Marketplace;
use App\Models\User;
use App\Resources\MarketplaceResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MarketplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(MarketplaceRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->password),
        ]);

        $marketplace = Marketplace::create([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'user_id' => $user->id,
            'password' => Hash::make($request->password),
        ]);

        return new MarketplaceResource($marketplace);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marketplace $marketplace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marketplace $marketplace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marketplace $marketplace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marketplace $marketplace)
    {
        //
    }
}
