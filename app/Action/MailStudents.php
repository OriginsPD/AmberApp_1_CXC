<?php

namespace App\Action;

use App\Mail\StudentApproval;
use App\Models\Students;
use App\Models\Subject;
use App\Models\SubjectChoice;
use Illuminate\Support\Facades\Mail;

class MailStudents
{
    public function execute(SubjectChoice $choice): void
    {
        $email = Students::where('id',$choice->student_id)
            ->get();

        $subject = Subject::where('id',$choice->subject_id)
            ->get();

        $studentMail = $email[0]->email;

        Mail::to($studentMail)
            ->send(new StudentApproval($subject));

    }
}
