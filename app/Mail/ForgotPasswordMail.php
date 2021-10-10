<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;

    public function __construct($data,$view)
    {
        $this->data = $data;
        $this->view = $view;
    }

    public function build()
    {      
        if($this->view=='admin')
        {
            $viewName='admin.mail.forgot-password-email';
        }
        else if($this->view=='web')
        {
            $viewName='web.forgot.forgot-password-email';
        }
        $this->from(config('constants.FROMADDRESS'), config('constants.FROMNAME'));
        $this->replyTo(config('constants.FROMADDRESS'), config('constants.FROMNAME'));
        $this->subject('Forgot Password');

        return $this->view($viewName, ['user' => $this->data]);
    }
}