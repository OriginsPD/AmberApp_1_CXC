<?php

namespace App\Action;

use App\Mail\TeacherApproval;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Mail;

class MailTeachers
{
    public function execute(Teacher $teacher)
    {
        $subject = Subject::where('id',$teacher->subject_id)
            ->get();

        Mail::to($teacher->email)
            ->send(new TeacherApproval($teacher,$subject));
    }
}
