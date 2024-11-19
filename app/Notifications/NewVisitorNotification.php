<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Visitor;

class NewVisitorNotification extends Notification
{
    use Queueable;

    protected $visitor;

    public function __construct(Visitor $visitor)
    {
        $this->visitor = $visitor;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'visitor_id' => $this->visitor->id,
            'message' => $this->visitor->name . ' is here to meet you.',
            'visitor_name' => $this->visitor->name,
            'purpose' => $this->visitor->purpose,
            'check_in' => $this->visitor->check_in,
        ];
    }
} 