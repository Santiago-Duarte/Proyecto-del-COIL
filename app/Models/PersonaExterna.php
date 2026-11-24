<?php

namespace App\Models;

use Database\Factories\PersonaExternaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nombre', 'apellidos', 'email', 'celular'])]
class PersonaExterna extends Model
{
    /** @use HasFactory<PersonaExternaFactory> */
    use HasFactory;
}
