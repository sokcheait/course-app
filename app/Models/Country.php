<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\State;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'iso3', 'phone_code', 'currency', 'is_active'
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }
}
