<?php

namespace App\Models;

use App\Enums\PartyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_id',
        'name',
        'tax_id',
        'website'
    ];

    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }
} 