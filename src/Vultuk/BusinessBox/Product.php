<?php namespace Vultuk\BusinessBox;

use Vultuk\BusinessBox\Extensions\Arrayable;
use Vultuk\BusinessBox\Extensions\MagicSetter;
use Vultuk\BusinessBox\Extensions\Validation;

abstract class Product
{
    use Arrayable, MagicSetter, Validation;

    public static function create(array $allDetails)
    {
        $product = new static();

        $product->arrayData = $allDetails;

        return $product;
    }

    public function getKey()
    {
        return $this->key;
    }

}