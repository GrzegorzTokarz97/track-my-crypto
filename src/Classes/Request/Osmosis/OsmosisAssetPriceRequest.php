<?php

declare(strict_types=1);

namespace App\Classes\Request\Osmosis;

use App\Classes\Request\AbstractRequest;
use App\Classes\Response\PriceResponse;

/**
 * @method PriceResponse executeRequest(array $params = [], array $query = [])
 */
class OsmosisAssetPriceRequest extends AbstractRequest
{
    protected function getUri(): string
    {
        return '/tokens/v1/price/%s';
    }

    protected function getResponseClass(): string
    {
        return PriceResponse::class;
    }
}
