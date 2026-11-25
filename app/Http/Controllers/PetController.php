<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pets = Pet::with('owner')
            ->orderBy('name')
            ->paginate(15);

        return view('pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $owners = Owner::orderBy('name')->get(['id', 'name']);

        return view('pets.create', compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePetRequest $request): RedirectResponse
    {
        Pet::create($request->validated());

        return to_route('pets.index')
            ->with('success', 'Pet created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet): View
    {
        $pet->load(['owner', 'appointments.veterinarian']);

        return view('pets.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet): View
    {
        $owners = Owner::orderBy('name')->get(['id', 'name']);

        return view('pets.edit', compact('pet', 'owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePetRequest $request, Pet $pet): RedirectResponse
    {
        $pet->update($request->validated());

        return to_route('pets.index')
            ->with('success', 'Pet updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet): RedirectResponse
    {
        $pet->delete();

        return to_route('pets.index')
            ->with('success', 'Pet deleted successfully.');
    }
}
