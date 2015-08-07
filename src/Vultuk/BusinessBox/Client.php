<?php

namespace Vultuk\BusinessBox;

use Vultuk\BusinessBox\Contracts\Client as ClientContract;
use Vultuk\BusinessBox\Extensions\Arrayable;
use Vultuk\BusinessBox\Extensions\MagicSetter;

class Client implements ClientContract
{
    use Arrayable, MagicSetter;

    public static function create(array $allDetails)
    {
        $product = new static();

        $product->arrayData = $allDetails;

        return $product;
    }

}
