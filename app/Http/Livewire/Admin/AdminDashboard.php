<?php

namespace App\Http\Livewire\Admin;

use App\Models\Students;
use App\Models\Subject;
use App\Models\SubjectChoice;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDashboard extends Component
{
    use WithPagination;

    public $subjects = [];
    public $students = [];
    public $search = '';

    public $student_id;
    public $subject_id;
    public $examDate;

    protected $rules = [
        'subject_id' => 'required',
        'student_id' => 'required',
        'examDate' => 'required|after:2021'
    ];

    public function storeChoice(): void
    {
        $this->validate();

        (SubjectChoice::where([
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
        ])
            ->exists())
            ? $this->addError('student_id','Student Have Already Been Added')
            : SubjectChoice::create([
                'student_id' => $this->student_id,
                'subject_id' => $this->subject_id,
                'year_of_exam' => $this->examDate
            ]);

        session()->flash('success', 'Subject Choice Added Successfully');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function updated(): void
    {
        $this->validateOnly('examDate');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard', [
            'studentChoices' => SubjectChoice::with(['students' => function($query){
                $query->where('first_nm', 'like', '%'.$this->search.'%');
                $query->orWhere('last_nm', 'like', '%'.$this->search.'%');
            }, 'subjects'])->whereHas('students',function ($query){
                $query->where('first_nm', 'like', '%'.$this->search.'%');
                $query->orWhere('last_nm', 'like', '%'.$this->search.'%');
            })
                ->paginate(4),
            $this->students = Students::all(),
            $this->subjects = Subject::all()
        ])
            ->extends('layouts.admin');
    }
}
