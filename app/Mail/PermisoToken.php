<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermisoToken extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $email;
    public $name;

    public function __construct($data,$name,$email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permiso Token',
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
        
        if($rolname == "Customer"){
            return new Content(
                view: 'mails.Vista_Permiso_Customer',
            );
        }else if($rolname == "Supervisor"){
            return new Content(
                view: 'mails.Vista_Permiso_Supervisor',
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
