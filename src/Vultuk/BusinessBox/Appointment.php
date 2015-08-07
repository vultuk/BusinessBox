<?php

namespace Vultuk\BusinessBox;

use Carbon\Carbon;
use Vultuk\BusinessBox\Contracts\Appointment as AppointmentContract;
use Vultuk\BusinessBox\Extensions\Arrayable;

class Appointment implements AppointmentContract
{
    use Arrayable;

    public function setAppointmentDateTime(Carbon $date)
    {
        $this->arrayData['time'] = $date->format('H:i');
        $this->arrayData['date'] = $date->format('d/m/Y');

        return $this;
    }

    public function setAppointmentNote($note)
    {
        $this->arrayData['notes'] = $note;

        return $this;
    }
    
    public static function create(Carbon $appointmentDate, $appointmentNotes)
    {
        $appointment = new self($appointmentDate, $appointmentNotes);

        return $appointment;
    }

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
