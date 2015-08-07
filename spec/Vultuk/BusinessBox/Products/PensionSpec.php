<?php

namespace spec\Vultuk\BusinessBox\Products;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Vultuk\BusinessBox\Product;
use Vultuk\BusinessBox\Products\ProductContract;

class PensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Vultuk\BusinessBox\Products\Pension');
    }


}
