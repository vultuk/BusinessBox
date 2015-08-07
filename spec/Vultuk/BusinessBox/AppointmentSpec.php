<?php

namespace spec\Vultuk\BusinessBox;

use Carbon\Carbon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AppointmentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Vultuk\BusinessBox\Appointment');
    }

    function it_should_set_appointment_time()
    {
        // $this->setAppoinmentDate(new Carbon('2015-11-15'));
    }
}
