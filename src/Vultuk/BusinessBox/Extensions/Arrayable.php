<?php namespace Vultuk\BusinessBox\Extensions;

trait Arrayable
{

    protected $arrayData = [];

    public function toArray()
    {
        // Check everything is validated before the transform
        $this->validate();

        return $this->arrayData;
    }

}