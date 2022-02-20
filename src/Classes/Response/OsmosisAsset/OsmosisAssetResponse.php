<?php

declare(strict_types=1);

namespace App\Classes\Response\OsmosisAsset;

use App\Classes\Response\ResponseInterface;
use JMS\Serializer\Annotation as JMS;

class OsmosisAssetResponse implements ResponseInterface
{
    #[JMS\Type(name: 'string')]
    private string $denom;

    #[JMS\Type(name: 'string')]
    private string $symbol;

    #[JMS\Type(name: 'string')]
    private string $name;

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDenom(): string
    {
        return $this->denom;
    }
}
