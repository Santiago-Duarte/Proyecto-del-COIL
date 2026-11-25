<?php

namespace App\Models;

use Database\Factories\VeterinarianFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'specialty', 'phone', 'email', 'is_active'])]
class Veterinarian extends Model
{
    /** @use HasFactory<VeterinarianFactory> */
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the appointments assigned to this veterinarian.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
