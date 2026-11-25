<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVeterinarianRequest;
use App\Models\Veterinarian;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VeterinarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $veterinarians = Veterinarian::withCount('appointments')
            ->orderBy('name')
            ->paginate(15);

        return view('veterinarians.index', compact('veterinarians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('veterinarians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVeterinarianRequest $request): RedirectResponse
    {
        Veterinarian::create($request->validated());

        return to_route('veterinarians.index')
            ->with('success', 'Veterinarian created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Veterinarian $veterinarian): View
    {
        $veterinarian->load('appointments.pet.owner');

        return view('veterinarians.show', compact('veterinarian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Veterinarian $veterinarian): View
    {
        return view('veterinarians.edit', compact('veterinarian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreVeterinarianRequest $request, Veterinarian $veterinarian): RedirectResponse
    {
        $veterinarian->update($request->validated());

        return to_route('veterinarians.index')
            ->with('success', 'Veterinarian updated successfully.');
    }

    /**
     * Toggle the active status of the veterinarian (AJAX).
     */
    public function updateStatus(Request $request, Veterinarian $veterinarian): JsonResponse
    {
        $validated = $request->validate([
            'is_active' => ['required', 'boolean'],
        ]);

        $veterinarian->update(['is_active' => $validated['is_active']]);

        return response()->json([
            'success' => true,
            'is_active' => $veterinarian->is_active,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veterinarian $veterinarian): RedirectResponse
    {
        $veterinarian->delete();

        return to_route('veterinarians.index')
            ->with('success', 'Veterinarian deleted successfully.');
    }
}
