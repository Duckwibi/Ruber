<?php

namespace App\Mail\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable implements ShouldQueue{
    use Queueable, SerializesModels;

    public function __construct(
        public string $otp
    ){}

    public function envelope(): Envelope{
        return new Envelope(
            subject: "Verify Email",
        );
    }

    public function content(): Content{
        return new Content(
            view: "Mail.Customer.VerifyEmail",
        );
    }

    public function attachments(): array{
        return [];
    }
}
