<?php

include_once('vendor/autoload.php');

$result = (new \Vultuk\BusinessBox\Remote('/test-api/echo'))
    ->send(
        new \Vultuk\BusinessBox\Client(),
        new \Vultuk\BusinessBox\Products\Pension(),
        new \Vultuk\BusinessBox\Appointment()
    );


var_dump($result);