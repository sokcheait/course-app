<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_line_one',
        'address_line_two',
        'street',
        'city',
        'province',
        'postal_code',
        'country',
    ];

    /**
     * Get the parent addressable model (User, Company, Employee, etc.)
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
