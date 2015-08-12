<?php namespace Vultuk\BusinessBox\Extensions;

trait Arrayable
{

    protected $arrayData = [];

    /**
     * Converts all data from the product, client or appointment into an
     * array for easy use in other methods
     *
     * @return mixed
     */
    public function toArray()
    {
        // Check everything is validated before the transform
        $this->validate();

        return $this->arrayData;
    }

}