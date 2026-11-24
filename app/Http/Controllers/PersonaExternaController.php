<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonaExternaRequest;
use App\Models\PersonaExterna;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PersonaExternaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $personasExternas = PersonaExterna::query()->orderBy('id')->get();

        return view('personas-externas.index', compact('personasExternas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('personas-externas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonaExternaRequest $request): RedirectResponse
    {
        PersonaExterna::create($request->validated());

        return to_route('personas-externas.index')
            ->with('success', 'Registro guardado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersonaExterna $personaExterna): View
    {
        return view('personas-externas.edit', compact('personaExterna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonaExternaRequest $request, PersonaExterna $personaExterna): RedirectResponse
    {
        $personaExterna->update($request->validated());

        return to_route('personas-externas.index')
            ->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonaExterna $personaExterna): RedirectResponse
    {
        $personaExterna->delete();

        return to_route('personas-externas.index')
            ->with('success', 'Registro eliminado correctamente.');
    }
}
