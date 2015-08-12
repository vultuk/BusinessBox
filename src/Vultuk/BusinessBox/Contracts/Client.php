<?php namespace Vultuk\BusinessBox\Contracts;

/**
 * Interface to be used in Client classes to ensure required
 * functionality is available
 *
 * Interface Client
 * @package Vultuk\BusinessBox\Contracts
 */
interface Client
{
    /**
     * Converts all data from the client into an
     * array for easy use in other methods
     *
     * @return mixed
     */
    public function toArray();

    /**
     * Combines multiple lines of an address into a comma separated single line
     *
     * @param ...$lines
     * @return string
     */
    public static function combineAddress(...$lines);
    
}