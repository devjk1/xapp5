<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    public function incidents(): HasMany
    {
        return $this->hasMany(Incident::class);
    }
    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeSearchLastName(Builder $query, string $last_name): void
    {
        $query->where('last_name', 'LIKE', '%' . $last_name . '%');
    }

    public function scopeSearchFirstName(Builder $query, string $first_name): void
    {
        $query->where('first_name', 'LIKE', '%' . $first_name . '%');
    }
}
