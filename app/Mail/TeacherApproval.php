<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeacherApproval extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($teacher,$subject)
    {
        $this->details = [
            'email' => $teacher->email,
            'password' => 'password123',
            'name' => $teacher->first_nm." ".$teacher->last_nm,
            'subject' => $subject[0]->subject_nm
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Mail.TeacherApproval')
            ->subject('Teacher Approval');
    }
}
