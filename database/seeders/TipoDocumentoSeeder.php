<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['tipo_documento' => 'Cédula de Ciudadanía', 'abreviatura' => 'CC'],
            ['tipo_documento' => 'Número de Identificación Tributaria', 'abreviatura' => 'NIT'],
            ['tipo_documento' => 'Pasaporte', 'abreviatura' => 'PA'],
            ['tipo_documento' => 'Tarjeta de identidad', 'abreviatura' => 'TI'],
            ['tipo_documento' => 'Permiso por Protección Temporal', 'abreviatura' => 'PPT'],
        ];

        foreach ($tipos as $tipo) {
            TipoDocumento::updateOrCreate(
                ['abreviatura' => $tipo['abreviatura']],
                [...$tipo, 'estado' => true],
            );
        }
    }
}
