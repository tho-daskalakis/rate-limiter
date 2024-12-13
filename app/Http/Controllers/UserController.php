<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): void
    {
        $userData = $request->only(['name', 'password', 'timezone']);

        $currentUserHash = Utils::hashUserData($userData);

        // If no changes are made, return.
        if (Utils::hashUserData($user->only(['name', 'password', 'timezone']) == $currentUserHash)) return;

        // Check if user-update record already exists.
        if (Cache::store('redis')->has($user->email)) return;

        // Add new entry to cache.
        Cache::store('redis')->forever($user->email, $currentUserHash);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
