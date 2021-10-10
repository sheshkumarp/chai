<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCompleteMail extends Mailable
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
            $viewName='web.mail.order-complete-mail';
        }else if($this->view=='user')
        {
            $viewName='web.mail.order-complete-user-mail';
        }else if($this->view=='all-items-user')
        {
            $viewName='web.mail.order-complete-all-user-mail';
        }else if($this->view=='user-cb')
        {
            $viewName='web.mail.order-complete-online-bundle-mail';
        }else if($this->view=='user-tele')
        {
            $viewName='web.mail.order-complete-teleconference-mail';
        }else if($this->view=='user-livelecture')
        {
            $viewName='web.mail.order-complete-live-lecture-mail';
        }else if($this->view=='user-unlimitedcle')
        {
            $viewName='web.mail.order-complete-unlimitedcle-mail';
        }else if($this->view=='user-compliance')
        {
            $viewName='web.mail.order-complete-compliance-mail';
        }else if($this->view=='user-course')
        {
            $viewName='web.mail.order-complete-course-mail';
        }

        
        //dd($this->data);
        
        $this->from(config('constants.FROMADDRESS'), config('constants.FROMNAME'));
        $this->replyTo(config('constants.FROMADDRESS'), config('constants.FROMNAME'));

        $this->subject('Order Success');
        $this->view($viewName, ['order' => $this->data]);
        
        return $this;
    }
}
