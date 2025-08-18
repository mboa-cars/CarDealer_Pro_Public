<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTemporaryPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public string $temporaryPassword;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $temporaryPassword)
    {
        $this->user = $user;
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Your new temporary password')
            ->markdown('emails.new-temporary-password', [
                'user' => $this->user,
                'temporaryPassword' => $this->temporaryPassword,
                'appName' => config('app.name'),
                'loginUrl' => route('login'),
            ]);
    }
}
