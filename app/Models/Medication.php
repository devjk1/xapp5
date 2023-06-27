<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medication extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function invoiceItems(): MorphMany
    {
        return $this->morphMany(InvoiceItem::class, 'iitemable');
    }

    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'oitemable');
    }

    public function scopeSearchMedication(Builder $query, string $medication): void
    {
        $query->where('name', 'LIKE', '%' . $medication . '%');
    }
}
