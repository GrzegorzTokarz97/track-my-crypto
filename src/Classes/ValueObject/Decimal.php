<?php

declare(strict_types=1);

namespace App\Classes\ValueObject;

use PrestaShop\Decimal\DecimalNumber;

class Decimal
{
    public function __construct(
        private DecimalNumber $internalNumber
    ){}

    public static function fromString(string $value): self
    {
        return new self(new DecimalNumber($value));
    }
}
