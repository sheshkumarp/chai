<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsMail extends Mailable
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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if($this->view=='admin')
        {
            $viewName='web.pages.contact-us-mail';
            //Attachment
            if (!empty($this->data['uploaded']) && sizeof($this->data['uploaded']) > 0) 
            {
                foreach ($this->data['uploaded'] as $key=>$attachment) 
                {                               
                    $this->attach($attachment['path']);
                }
            }
        }
        else if($this->view=='user')
        {
            $viewName='web.pages.contact-us-mail-user';
        }
        
        $this->from(config('constants.FROMADDRESS'), config('constants.FROMNAME'));
        $this->replyTo(config('constants.FROMADDRESS'), config('constants.FROMNAME'));

        $this->subject('Contact Us');
        $this->view($viewName, ['data' => $this->data]);
        
        return $this;
    }
}
