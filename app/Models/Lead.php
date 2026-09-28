<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'company',
    'trade',
    'crew_size',
    'phone',
    'email',
    'headache',
    'preferred_contact_method',
])]
class Lead extends Model
{
    use HasUlids;

    public const array TRADES = [
        'plumbing' => 'Plumbing',
        'hvac' => 'HVAC',
        'electrical' => 'Electrical',
        'painting_drywall' => 'Painting & Drywall',
        'roofing' => 'Roofing',
        'other' => 'Other',
    ];

    public const array CREW_SIZES = [
        '1_4' => '1-4',
        '5_14' => '5-14',
        '15_49' => '15-49',
        '50_plus' => '50+',
    ];

    public const array CONTACT_METHODS = [
        'phone' => 'Phone',
        'email' => 'Email',
        'text' => 'Text',
    ];
}
