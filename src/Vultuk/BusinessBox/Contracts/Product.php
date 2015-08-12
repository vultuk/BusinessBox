<?php namespace Vultuk\BusinessBox\Contracts;

/**
 * Interface to be used on all products. Most methods are implemented
 * inside Extension traits
 *
 * Interface Product
 * @package Vultuk\BusinessBox\Contracts
 */
interface Product
{

    /**
     * Converts all data from the product into an array for easy use in other methods
     *
     * @return mixed
     */
    public function toArray();

    /**
     * Gets the key used for this product which is required for sending
     * product details to the API
     *
     * @return mixed
     */
    public function getKey();

}