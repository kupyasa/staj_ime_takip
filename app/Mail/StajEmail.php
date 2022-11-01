<?php

namespace App\Mail;

use App\Models\Staj;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StajEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $staj;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Staj $staj)
    {
        $this->staj = $staj;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Staj Bilgilerinde Değişiklik')
                    ->view('emails.stajemail');
    }
}
