<?php

declare(strict_types=1);

namespace App\Classes\Response;
use JMS\Serializer\Annotation as JMS;

final class PriceResponse implements ResponseInterface
{
    #[JMS\Type(name: 'string')]
    private string $price;

    public function getPrice(): string
    {
        return $this->price;
    }
}
