<?php

namespace App\Mail;
use App\Models\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Leave $leave;

    public function __construct(Leave $leave)
    {
        $this->leave = $leave->loadMissing('user');
    }

    public function build()
    {
        $subject = 'Your Leave Request was ' . ucfirst($this->leave->status);

        return $this->subject($subject)
            ->markdown('emails.leaves.status_updated', [
                'leave' => $this->leave,
            ]);
    }
}