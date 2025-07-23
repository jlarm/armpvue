<?php

namespace App\Domains\Dealership\Events;

use App\Domains\Dealership\Models\Dealership;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DealershipUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Dealership $original,
        public readonly Dealership $updated
    ) {}
}
