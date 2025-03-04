<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.registration_success')
                    ->with([
                        'userId' => $this->data['id'],
                        'email' => $this->data['email'],
                        'password' => $this->data['password'],
                        'message' => 'You are registered successfully'
                    ]);
    }
}
