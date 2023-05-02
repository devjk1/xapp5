<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function invoiceItems(): MorphMany
    {
        return $this->morphMany(InvoiceItem::class, 'iitemable');
    }
}
