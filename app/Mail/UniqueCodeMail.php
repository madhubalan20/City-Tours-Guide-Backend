<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UniqueCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code, $name;

    /**
     * Create a new message instance.
     */
    public function __construct($code, $name)
    {
        $this->code = $code;
        $this->name = $name;

    }

    public function build()
    {

                    $subject ="Verify Your Email Address";
                  $mail_content="";
           
                  try{
                    return $this->markdown('emails.unique-code')
                       
                    ->subject($subject)
                    ->with([
                        'content' => $mail_content,
                    ]);
                  }catch(\Exception $e){

                    return $e;
                  }         
    }

    /**
     * Get the message envelope.
     */
    
}
