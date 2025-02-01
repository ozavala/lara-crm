<?php

namespace App\Models;

use App\Enums\PartyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_type'
    ];

    protected $casts = [
        'party_type' => PartyType::class
    ];

    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
} 