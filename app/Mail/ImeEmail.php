<?php

namespace App\Mail;

use App\Models\Ime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ImeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ime;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ime)
    {
        $this->ime = $ime;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('İME Bilgilerinde Değişiklik')
                    ->view('emails.imeemail');
    }
}
