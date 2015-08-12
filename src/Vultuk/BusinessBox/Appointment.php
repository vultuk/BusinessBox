<?php

namespace Vultuk\BusinessBox;

use Carbon\Carbon;
use Vultuk\BusinessBox\Contracts\Appointment as AppointmentContract;
use Vultuk\BusinessBox\Extensions\Arrayable;
use Vultuk\BusinessBox\Extensions\MagicSetter;
use Vultuk\BusinessBox\Extensions\Validation;

/**
 * Class Appointment
 * @package Vultuk\BusinessBox
 */
class Appointment implements AppointmentContract
{
    use Arrayable, MagicSetter, Validation;

    /**
     * Sets the date and time based on the provided Carbon object
     *
     * @param Carbon $date
     * @return $this
     */
    public function setAppointmentDateTime(Carbon $date)
    {
        $this->arrayData['time'] = $date->format('H:i');
        $this->arrayData['date'] = $date->format('d/m/Y');

        return $this;
    }

    /**
     * Sets a note for this appointment in plain text
     *
     * @param $note
     * @return $this
     */
    public function setAppointmentNote($note)
    {
        $this->arrayData['notes'] = $note;

        return $this;
    }

    /**
     * Creates an appointment based on the 2 provided attributes
     *
     * @param Carbon $appointmentDate
     * @param $appointmentNotes
     * @return Appointment
     */
    public static function create(Carbon $appointmentDate, $appointmentNotes)
    {
        $appointment = new self($appointmentDate, $appointmentNotes);

        return $appointment;
    }

    /**
     * Basic construct which can also create the full appointment object
     * if the correct attributes are provided
     *
     * @param Carbon|null $appointmentDate
     * @param null $appointmentNotes
     */
    public function __construct(Carbon $appointmentDate = null, $appointmentNotes = null)
    {
        // If appointment date has been sent then set it
        if (!empty($appointmentDate))
        {
            $this->setAppointmentDateTime($appointmentDate);
        }

        // If appointment notes have been sent then set it
        if (!empty($appointmentNotes))
        {
            $this->setAppointmentNote($appointmentNotes);
        }
    }

}
