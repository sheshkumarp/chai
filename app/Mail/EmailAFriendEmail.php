<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailAFriendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;

    public function __construct($data, $view)
    {
        $this->data = $data;
        $this->view = $view;
    }

    public function build()
    {
        $viewName = 'web.mail.email-a-friend-email-template';
     
        return $this->view($viewName, ['email' => $this->data]);
    }
}