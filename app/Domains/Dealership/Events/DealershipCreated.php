<?php

namespace App\Domains\Dealership\Events;

use App\Domains\Dealership\Models\Dealership;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DealershipCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Dealership $dealership
    ) {}
}
