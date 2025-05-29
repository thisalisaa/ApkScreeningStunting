<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationToken;

    /**
     * Create a new message instance.
     *
     * @param  User  $user
     * @param  string  $verificationToken
     */
    public function __construct(User $user, string $verificationToken)
    {
        $this->user = $user;
        $this->verificationToken = $verificationToken;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Email Verification')
                    ->view('auth.verify-email')
                    ->with([
                        'name' => $this->user->nama,
                        'verificationToken' => $this->verificationToken,
                    ]);
    }
}
