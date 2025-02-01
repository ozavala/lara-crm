<?php

namespace App\Enums;

enum PartyType: string
{
    case PERSON = 'person';
    case ORGANIZATION = 'organization';

    public function label(): string
    {
        return match($this) {
            self::PERSON => 'Person',
            self::ORGANIZATION => 'Organization',
        };
    }
} 