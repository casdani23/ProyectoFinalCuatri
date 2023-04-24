<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermisoConToken extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $data;
    public $email;
    public $name;
    public $crip;

    public function __construct($data,$name,$email,$crip)
    {
        $this->data = $data;
        $this->name = $name;
        $this->email = $email;
        $this->crip = $crip;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Envio token',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $rolname = "";

        foreach (auth()->user()->roles as $role) {
            $rolname = $role->name;
        }
        
        if($rolname == "Admin"){
            return new Content(
                view: 'mails.Vista_Token_Supervisor',
            );
        }else if($rolname == "Supervisor"){
            return new Content(
                view: 'mails.Vista_Token_Customer',
            );
        }
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
