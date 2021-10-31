<?php

namespace App\Http\Livewire\Admin;

use App\Action\MailTeachers;
use App\Models\Subject;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTeacher extends Component
{
    use WithPagination;

    public $teacherId;
    public $first_nm;
    public $last_nm;
    public $dob;
    public $subject_id;
    public $gender;

    public $search = '';

    public $teacherEdit = false;

    protected $listeners = ['refresh' => 'alertSent'];

    protected $rules = [
        'first_nm' => 'required|string',
        'last_nm' => 'required|string',
        'dob' => 'required|before:31-12-1999',
        'subject_id' => 'required',
        'gender' => 'required',
    ];

    public function storeEdit(): void
    {
        $this->validate();

        Teacher::where('id', $this->teacherId)->update([
            'first_nm' => $this->first_nm,
            'last_nm' => $this->last_nm,
            'dob' => $this->dob,
            'subject_id' => $this->subject_id,
            'gender' => $this->gender,
        ]);

        $this->teacherId = '';
        $this->first_nm = '';
        $this->last_nm = '';
        $this->dob = '';
        $this->subject_id = '';
        $this->gender = '';

        session()->flash('success', 'Teacher Detail Updated Successfully');

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert-modal');
    }

    public function editTeacher(Teacher $teacher): void
    {

        $this->teacherId = $teacher->id;
        $this->first_nm = $teacher->first_nm;
        $this->last_nm = $teacher->last_nm;
        $this->dob = $teacher->dob;
        $this->subject_id = $teacher->subject_id;
        $this->gender = $teacher->gender;

        $this->teacherEdit = true;
        $this->dispatchBrowserEvent('show-modal');

    }

    public function changeStatus(Teacher $teacher,$status,
                                 MailTeachers $mail)
    {
        Teacher::where('id',$teacher->id)->update([
            'status' => $status,
        ]);

        if ($status){

            $mail->execute($teacher);

        }

        session()->flash('success', 'Teacher Status Changed');

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert-modal');
    }

    public function updated(): void
    {
        $this->validate([
            'first_nm' => 'string',
            'last_nm' => 'string',
            'dob' => 'before:31-12-1999',
        ]);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.admin-teacher', [
            'teachers' => Teacher::with('subjectChoice', 'subjects')
                ->where('first_nm', 'like', '%' . $this->search . '%')
                ->orWhere('last_nm', 'like', '%' . $this->search . '%')
                ->paginate(4),
            'subjects' => Subject::all()
        ])
            ->extends('layouts.admin');
    }

    public function alertSent(): void
    {
        session()->flash('success', 'New Teacher Added Successfully');

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert-modal');
    }
}
