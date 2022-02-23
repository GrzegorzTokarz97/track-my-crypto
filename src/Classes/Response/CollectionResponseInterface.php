<?php

declare(strict_types=1);

namespace App\Classes\Response;

use Doctrine\Common\Collections\ArrayCollection;

interface CollectionResponseInterface extends ResponseInterface
{
    public const COLLECTION_NAME = null;

    public function getValue(): ArrayCollection;

    public function setValue(ArrayCollection $value): void;
}
