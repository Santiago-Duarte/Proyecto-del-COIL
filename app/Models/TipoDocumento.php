<?php

namespace App\Models;

use Database\Factories\TipoDocumentoFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['tipo_documento', 'abreviatura', 'estado'])]
class TipoDocumento extends Model
{
    /** @use HasFactory<TipoDocumentoFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
        ];
    }
}
