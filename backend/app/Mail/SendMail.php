<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $img_url = 'logo.png';
        return $this
            /*
            ->attach('E:\Zlecenia\ai2-2022-projekt-lab2-z4\frontend\src\assets\logo.png', [ //absolute path
                'as' => 'logo.png',
                'mime' => 'images/png'
            ])
            */
                //->attach(public_path('/logo.png'))
            ->view('Email.resetPassword')->with([
                'token' => $this->token,
            ]);
    }
}
