<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Models\Owner;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $owners = Owner::withCount('pets')
            ->orderBy('name')
            ->paginate(15);

        return view('owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOwnerRequest $request): RedirectResponse
    {
        Owner::create($request->validated());

        return to_route('owners.index')
            ->with('success', 'Owner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner): View
    {
        $owner->load('pets');

        return view('owners.show', compact('owner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner): View
    {
        return view('owners.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOwnerRequest $request, Owner $owner): RedirectResponse
    {
        $owner->update($request->validated());

        return to_route('owners.index')
            ->with('success', 'Owner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner): RedirectResponse
    {
        $owner->delete();

        return to_route('owners.index')
            ->with('success', 'Owner deleted successfully.');
    }
}
