<?php

declare(strict_types=1);

namespace App\Classes\Response\OsmosisAsset;

use App\Classes\Response\CollectionResponseInterface;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

final class OsmosisAssetCollectionResponse implements CollectionResponseInterface
{
    public const COLLECTION_NAME = 'value';

    #[
        JMS\Type(name: 'ArrayCollection<App\Classes\Response\OsmosisAsset\OsmosisAssetResponse>'),
        JMS\Accessor(getter: 'getValue', setter: 'setValue')
    ]
    private ArrayCollection $value;

    public function getValue(): ArrayCollection
    {
        return $this->value;
    }

    public function setValue(ArrayCollection $value): void
    {
        $this->value = $value;
    }

    /**
     * @return ArrayCollection<OsmosisAssetResponse>
     */
    public function getAssets(): ArrayCollection
    {
        return $this->value;
    }
}
