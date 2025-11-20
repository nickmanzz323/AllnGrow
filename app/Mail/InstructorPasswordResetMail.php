<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InstructorPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $name;
    public $resetUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($token, $name)
    {
        $this->token = $token;
        $this->name = $name;
        $this->resetUrl = url('/instructor/password/reset/' . $token);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Your AllnGrow Instructor Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.instructor-password-reset',
        );
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
