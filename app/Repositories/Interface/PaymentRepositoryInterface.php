<?php

namespace App\Repositories\Interface;

use stdClass;

interface PaymentRepositoryInterface
{
    public function initialize(object $data): stdClass;

    public function verify(string $reference, int $amount): bool;

    public function refund(string $reference, ?int $amount = null): stdClass;
}
