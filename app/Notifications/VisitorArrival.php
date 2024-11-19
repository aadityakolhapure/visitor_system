<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Visitor;

class VisitorArrival extends Mailable
{
    use Queueable, SerializesModels;

    public $visitor;

    public function __construct(Visitor $visitor)
    {
        $this->visitor = $visitor;
    }

    public function build()
    {
        return $this->view('emails.visitor-arrival')
                    ->subject('New Visitor Arrival');
    }
}
