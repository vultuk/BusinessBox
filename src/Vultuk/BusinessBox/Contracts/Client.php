<?php namespace Vultuk\BusinessBox\Contracts;

interface Client
{

    public function toArray();

    public function combineAddress(...$lines);
    
}