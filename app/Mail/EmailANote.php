<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailANote extends Mailable
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
        $viewName = 'web.mail.email-a-note-template';
     
        return $this->view($viewName, ['data' => $this->data]);
    }
}