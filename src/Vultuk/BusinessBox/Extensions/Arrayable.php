<?php namespace Vultuk\BusinessBox\Extensions;

trait Arrayable
{

    protected $arrayData = [];

    public function toArray()
    {
        return $this->arrayData;
    }

}