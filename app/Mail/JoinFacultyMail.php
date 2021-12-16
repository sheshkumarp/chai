<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JoinFacultyMail extends Mailable
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
       /* $mailable =  $this->from($this->data['emailFrom'], $this->data['emailFromName']);
        $mailable->to($this->data['emailTo']);
        $mailable->subject($this->data['subject']);
        $mailable->markdown('web.faculty.join-faculty-mail',['data' => $this->data]);
        if($this->data['uploaded']) {
            foreach ($this->data['uploaded'] as $key=>$attachment) 
            {                               
                $mailable->attach($attachment['path']);
            }
        }
        return $mailable; */   

        $this->from(config('constants.FROMADDRESS'), config('constants.FROMNAME'));
        $this->replyTo(config('constants.FROMADDRESS'), config('constants.FROMNAME'));
        $this->subject($this->data['subject']);
        $this->view('web.faculty.join-faculty-mail', ['data' => $this->data]);//['data' => $this->data]

        if (!empty($this->data['uploaded']) && sizeof($this->data['uploaded']) > 0) 
        {
            foreach ($this->data['uploaded'] as $key=>$attachment) 
            {                               
                $this->attach($attachment['path']);
            }
        }

        return $this;      
    }
}
