<?php

declare(strict_types=1);

namespace App\Classes\Request\Osmosis;

use App\Classes\Request\AbstractRequest;
use App\Classes\Response\OsmosisAsset\OsmosisAssetCollectionResponse;

/**
 * @method OsmosisAssetCollectionResponse executeRequest(array $params = [], array $query = [])
 */
class OsmosisAssetsRequest extends AbstractRequest
{
    protected function getUri(): string
    {
        return '/tokens/v1/all';
    }

    protected function getResponseClass(): string
    {
        return OsmosisAssetCollectionResponse::class;
    }
}
