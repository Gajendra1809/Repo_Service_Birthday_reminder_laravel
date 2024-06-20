<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class BirthdayReminderMail
 *
 * This mailable class is responsible for sending birthday reminder emails.
 * It queues the email to be sent
 */
class BirthdayReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $birthdayName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($birthdayName)
    {
        $this->birthdayName = $birthdayName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Birthday Reminder Mail')
                    ->view('emails.birthday_reminder')
                    ->with(['name' => $this->birthdayName]);
    }
}
