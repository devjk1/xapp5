<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}
