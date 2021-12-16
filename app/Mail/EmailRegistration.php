<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailRegistration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;
    public function __construct($data)
    {
         $this->data = $data;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // dd($this->data);
        /*$mailable =  $this->from($this->data['strFrom'], $this->data['strFromName']);
        $mailable->to($this->data['strTo']);
        $mailable->subject($this->data['strSubject']);
        $mailable->markdown('web.pages.email-registration',$this->data);
        return $mailable;  */ 
        $this->from(config('constants.FROMADDRESS'), config('constants.FROMNAME'));
        $this->replyTo(config('constants.FROMADDRESS'), config('constants.FROMNAME'));
        $this->subject($this->data['strSubject']);
        return $this->view('web.pages.email-registration', $this->data);//['data' => $this->data]

       // return $this;     
    }
}
