<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPsychologistApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Lamaran Psikolog Baru - Consult by Reed Code')
                    ->view('emails.admin.psychologistApplication')
                    ->attach($this->details['cv']->getRealPath(), [
                        'as' => $this->details['cv']->getClientOriginalName(),
                        'mime' => $this->details['cv']->getMimeType(),
                    ]);
    }
} 