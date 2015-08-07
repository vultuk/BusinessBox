<?php

namespace Vultuk\BusinessBox\Products;

use Vultuk\BusinessBox\Contracts\Product as ProductContract;
use Vultuk\BusinessBox\Extensions\Arrayable;
use Vultuk\BusinessBox\Product;

class Pension extends Product implements ProductContract
{
    use Arrayable;

    public $key = 'pension';

}
