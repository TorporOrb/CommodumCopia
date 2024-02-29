<?php

/*
titel: WelcomeMail
beschrijving: De MailController is verantwoordelijk voor het verzenden van e-mails.
    De sendEmail methode haalt de welkomstmail op en verzendt deze naar het opgegeven adres.
auteur: Pascal Thomasse Mol
versie: 1
aanmaaktdatum: 19 jun 2023
laatste wijzigingsdatum: 19 jun 2023
*/

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welkom bij Commodum Copia',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content())->view('mail.welcomeMail');
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