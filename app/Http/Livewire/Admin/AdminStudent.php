<?php

namespace App\Http\Livewire\Admin;

use App\Models\Students;
use App\Models\Subject;
use App\Models\SubjectChoice;
use Livewire\Component;
use Livewire\WithPagination;

class AdminStudent extends Component
{
    use WithPagination;

    public $studentChoices;
    public $studentInfo = [];


    public $choiceId;
    public $search = '';

    public $studentId;
    public $first_nm;
    public $last_nm;
    public $dob;
    public $class;
    public $phone_nbr;
    public $gender;

    public $studentEdit = false;
    public $studentView = false;

    protected $listeners = ['refresh' => 'alertSent'];

    protected $rules = [
        'first_nm' => 'required|string',
        'last_nm' => 'required|string',
        'dob' => 'required|before:31-12-1999',
        'class' => 'required',
        'phone_nbr' => 'required|numeric',
        'gender' => 'required',
    ];

    public function storeEdit(): void
    {
        $this->validate();

        Students::where('id', $this->studentId)->update([
            'first_nm' => $this->first_nm,
            'last_nm' => $this->last_nm,
            'dob' => $this->dob,
            'class' => $this->class,
            'phone_nbr' => $this->phone_nbr,
            'gender' => $this->gender,
        ]);

        $this->studentId = '';
        $this->first_nm = '';
        $this->last_nm = '';
        $this->dob = '';
        $this->class = '';
        $this->phone_nbr = '';
        $this->gender = '';

        session()->flash('success', 'Student Updated Successfully');

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert-modal');
    }

    public function editStudent(Students $student): void
    {

        $this->studentId = $student->id;
        $this->first_nm = $student->first_nm;
        $this->last_nm = $student->last_nm;
        $this->dob = $student->dob;
        $this->class = $student->class;
        $this->phone_nbr = $student->phone_nbr;
        $this->gender = $student->gender;

        $this->studentEdit = true;
        $this->dispatchBrowserEvent('show-modal');

    }

    public function updated(): void
    {
        $this->validate([
            'first_nm' => 'string',
            'last_nm' => 'string',
            'dob' => 'before:31-12-1999',
            'phone_nbr' => 'numeric',
        ]);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function viewStudent(Students $student): void
    {
        $this->studentView = true;
        $this->studentEdit = false;

        $this->studentInfo = SubjectChoice::with('students', 'subjects')
            ->where('student_id', $student->id)
            ->get();

        $this->dispatchBrowserEvent('show-modal');
    }

    public function statusChange(SubjectChoice $choice, $changeStatus): void
    {
        SubjectChoice::where('id', $choice->id)
            ->update([
                'status' => $changeStatus
            ]);

        session()->flash('success', 'Student Updated Successfully');

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert-modal');
        $this->dispatchBrowserEvent('alert-modal');

    }

    public function alertSent(): void
    {
        session()->flash('success', 'New Information Added Successfully');

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert-modal');
    }

    public function mount()
    {
        $this->emit('open-drop');
    }

    public function render()
    {
        return view('livewire.admin.admin-student', [

            'students' => Students::where('first_nm', 'like', '%' . $this->search . '%')
                ->orWhere('last_nm', 'like', '%' . $this->search . '%')
                ->paginate(4),
            'subjects' => Subject::paginate(4)

        ])
            ->extends('layouts.admin');
    }
}
