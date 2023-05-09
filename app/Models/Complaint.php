<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class)->withTimestamps();
    }
}
