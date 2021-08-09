<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $userName;
    public string $url;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param Request $request
     */
    public function __construct($user)
    {
        $this->userName = $user->name;
        $this->url = request()->server('HTTP_HOST');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome')
            ->subject('Welcome');
    }
}
