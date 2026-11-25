<?php

namespace App\Models;

use Database\Factories\OwnerFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'phone', 'email', 'address'])]
class Owner extends Model
{
    /** @use HasFactory<OwnerFactory> */
    use HasFactory;

    /**
     * Get the pets owned by this owner.
     */
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
