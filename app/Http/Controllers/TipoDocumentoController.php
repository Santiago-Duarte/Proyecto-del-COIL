<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoDocumentoRequest;
use App\Models\TipoDocumento;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TipoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tiposDocumentos = TipoDocumento::query()->orderBy('id')->get();

        return view('tipos-documentos.index', compact('tiposDocumentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tipos-documentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoDocumentoRequest $request): RedirectResponse
    {
        TipoDocumento::create([
            ...$request->validated(),
            'estado' => $request->boolean('estado'),
        ]);

        return to_route('tipos-documentos.index')
            ->with('success', 'Registro guardado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoDocumento $tipoDocumento): View
    {
        return view('tipos-documentos.edit', compact('tipoDocumento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoDocumentoRequest $request, TipoDocumento $tipoDocumento): RedirectResponse
    {
        $tipoDocumento->update([
            ...$request->validated(),
            'estado' => $request->boolean('estado'),
        ]);

        return to_route('tipos-documentos.index')
            ->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoDocumento $tipoDocumento): RedirectResponse
    {
        $tipoDocumento->delete();

        return to_route('tipos-documentos.index')
            ->with('success', 'Registro eliminado correctamente.');
    }
}
