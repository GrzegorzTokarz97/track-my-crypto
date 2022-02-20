<?php

declare(strict_types=1);

namespace App\Document;

use App\Classes\Response\OsmosisAsset\OsmosisAssetResponse;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document(collection: 'osmosis_asset')]
class OsmosisAsset
{
    #[MongoDB\Id]
    private readonly string $id;

    #[MongoDB\Field, MongoDB\Index(unique: true)]
    private string $symbol;

    #[MongoDB\Field, MongoDB\Index(unique: true)]
    private string $name;

    #[MongoDB\Field, MongoDB\Index(unique: true)]
    private string $denom;

    public function __construct(string $symbol, string $name, string $denom)
    {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->denom = $denom;
    }

    public static function createFromResponse(OsmosisAssetResponse $response): self
    {
        return new self($response->getSymbol(), $response->getName(), $response->getDenom());
    }

    public function getId(): string
    {
        return $this->id;
    }

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
