<?php
namespace App\Mail;

use App\Models\MedicalVisit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitScheduleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visit;

    public function __construct(MedicalVisit $visit)
    {
        $this->visit = $visit;
    }

    public function build()
    {
        return $this->subject('Your Visit Schedule')
                    ->view('emails.visit_schedule')
                    ->with([
                        'visit' => $this->visit,
                    ]);
    }
}
