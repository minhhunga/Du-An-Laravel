<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $data=[];

    public function __construct($data)
    {
        $this->data=$data;
    }

    public function build(){
    return $this->from('minhhung.dx1805@gmail.com', "test")
        ->subject($this->data['subject'])
            ->view("Frontend.email.index")
            ->with("data", $this->data)
            ->with("cart-product", $this->data['cart-product']);
}
   
}
