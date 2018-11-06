<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Resetpassword extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $token;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $_email, $_token)
    {
        $this->email = $_email;
        $this->token = $_token;
        $this->url = url(config('app.url').route('password.reset', $this->token, false));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->markdown('emails.resetpassword')
        ->subject('Reset wachtwoord');
    }
}
