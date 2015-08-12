<?php namespace Vultuk\BusinessBox\Contracts;

interface Appointment
{
    /**
     * Converts all data from the appointment into an
     * array for easy use in other methods
     *
     * @return mixed
     */
    public function toArray();

}