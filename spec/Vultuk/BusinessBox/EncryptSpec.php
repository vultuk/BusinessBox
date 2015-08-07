<?php

namespace spec\Vultuk\BusinessBox;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EncryptSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Vultuk\BusinessBox\Encrypt');
    }
}
