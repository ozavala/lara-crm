<?php

namespace App\Models;

use App\Enums\PartyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_id',
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }
} 