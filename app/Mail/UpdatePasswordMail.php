<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdatePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code, $name;

    public function __construct($code, $name)
    {
        $this->code = $code;
        $this->name = $name;
    }

    public function build()
    {
        
        $subject ="Reset Your Password";
        $mail_content="";
           
        try{
            return $this->markdown('emails.update-password')
            ->subject($subject)
            ->with([
                'content' => $mail_content,
            ]);
        }catch(\Exception $e){
            return $e;
        }         
    }

}
