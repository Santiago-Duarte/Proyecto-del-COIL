<?php

use App\Http\Controllers\PersonaExternaController;
use App\Http\Controllers\TipoDocumentoController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/personas-externas');
Route::redirect('/home', '/personas-externas');

Route::middleware('auth')->group(function (): void {
    Route::resource('personas-externas', PersonaExternaController::class)
        ->except(['show'])
        ->parameters(['personas-externas' => 'personaExterna']);

    Route::resource('tipos-documentos', TipoDocumentoController::class)
        ->except(['show'])
        ->parameters(['tipos-documentos' => 'tipoDocumento']);
});
