<?php namespace Vultuk\BusinessBox;

use Vultuk\BusinessBox\Extensions\Arrayable;
use Vultuk\BusinessBox\Extensions\MagicSetter;
use Vultuk\BusinessBox\Extensions\Validation;

/**
 * Abstract class to be extended by all products
 *
 * Class Product
 * @package Vultuk\BusinessBox
 */
abstract class Product
{
    use Arrayable, MagicSetter, Validation;

    /**
     * Create a product by sending all details in an array
     *
     * @param array $allDetails
     * @return static
     */
    public static function create(array $allDetails)
    {
        $product = new static();

        $product->arrayData = $allDetails;

        return $product;
    }

    /**
     * Gets the key used for this product which is required for sending
     * product details to the API
     *
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

}