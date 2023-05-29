<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class PatientData extends Data
{
    public function __construct(
        #[Max(50)]
        public string $first_name,
        #[Max(50)]
        public string $last_name,
    ) {}
}
