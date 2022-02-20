<?php

declare(strict_types=1);

namespace App\Classes\Response;

use Doctrine\Common\Collections\ArrayCollection;

interface CollectionResponseInterface extends ResponseInterface
{
    public function getValue(): ArrayCollection;

    public function setValue(ArrayCollection $value): void;
}
