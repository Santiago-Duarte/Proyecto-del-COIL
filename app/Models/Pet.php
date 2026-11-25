<?php

namespace App\Models;

use Database\Factories\PetFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'species', 'breed', 'owner_id', 'birth_date', 'gender', 'color', 'notes'])]
class Pet extends Model
{
    /** @use HasFactory<PetFactory> */
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    /**
     * Get the owner of this pet.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    /**
     * Get the appointments for this pet.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
