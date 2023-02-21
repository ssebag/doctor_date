<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $doctor;
    public $day;
    public $hour;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$doctor,$day,$hour)
    {
        $this->name=$name;
        $this->doctor=$doctor;
        $this->day=$day;
        $this->hour=$hour;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.appointmentAccepted');
    }
}
