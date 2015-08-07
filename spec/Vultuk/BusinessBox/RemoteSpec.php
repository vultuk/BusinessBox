<?php

namespace spec\Vultuk\BusinessBox;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoteSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Vultuk\BusinessBox\Remote');
    }
}
