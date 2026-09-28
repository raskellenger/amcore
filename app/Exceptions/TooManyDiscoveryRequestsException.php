<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class TooManyDiscoveryRequestsException extends RuntimeException
{
    public function __construct(
        public readonly int $availableInSeconds,
    ) {
        parent::__construct('Too many discovery call requests from this address. Try again shortly.');
    }
}
