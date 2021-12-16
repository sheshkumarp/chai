<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMail extends Mailable
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
            $viewName='admin.mail.invoice-mail';
        }    

        if (!empty($this->data['attachment'])) 
            {
                 $this->attachData($this->data['attachment']->output(), "invoice.pdf");
            }   

        return $this->view($viewName, ['data' => $this->data]);
    }
}