<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Visit;

class VisitScheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $visit;

    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    public function build()
    {
        return $this->subject('Your Medical Visit is Scheduled')
                    ->view('emails.visit_scheduled')
                    ->with(['visit' => $this->visit]);
    }
}
