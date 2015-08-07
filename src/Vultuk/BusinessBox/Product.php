<?php namespace Vultuk\BusinessBox;

use Vultuk\BusinessBox\Extensions\MagicSetter;

abstract class Product
{
    use MagicSetter;

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