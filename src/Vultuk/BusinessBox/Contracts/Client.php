<?php namespace Vultuk\BusinessBox\Contracts;

interface Client
{

    public function toArray();

    public static function combineAddress(...$lines);
    
}