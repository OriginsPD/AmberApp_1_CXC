<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Students;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminNavi extends Component
{

    public $first_nm;
    public $last_nm;
    public $dob;
    public $class;
    public $phone_nbr;
    public $email;
    public $password = 'password123';
    public $gender;

    public $subject_nm;
    public $subject_id;
    public $cost_amt;

    public $subjectAdd = false;
    public $teacherAdd = false;

    protected $listeners =['open-drop' => 'render'];

    protected $rules = [
        'first_nm' => 'required|string',
        'last_nm' => 'required|string',
        'dob' => 'required|before:31-12-1999',
        'subject_id' => 'required',
        'email' => 'required|email|unique:users|unique:students',
        'password' => 'required|min:4',
        'gender' => 'required',
    ];


    public function createStudent(): void
    {
        $this->validate([
            'class' => 'required',
            'phone_nbr' => 'required|numeric'
        ]);

        $id =  User::create([
            'username' => $this->first_nm . " " . $this->last_nm,
            'email' => $this->email,
            'isAdmin' => 3,
            'password' => $this->password,
        ])->id;

        Students::create([
            'id' => $id,
            'first_nm' => $this->first_nm,
            'last_nm' => $this->last_nm,
            'dob' => $this->dob,
            'email' => $this->email,
            'phone_nbr' => $this->phone_nbr,
            'class' => $this->class,
            'gender' => $this->gender
        ]);

        session()->flash('success', 'Student Created Successfully');

        $this->emit('refresh');

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert-modal');
    }

    public function createTeacher(): void
    {
        $this->validate();

        $id =  User::create([
            'username' => $this->first_nm . " " . $this->last_nm,
            'email' => $this->email,
            'isAdmin' => 2,
            'password' => $this->password,
        ])->id;

        Teacher::create([
            'id' => $id,
            'first_nm' => $this->first_nm,
            'last_nm' => $this->last_nm,
            'dob' => $this->dob,
            'email' => $this->email,
            'subject_id' => $this->subject_id,
            'gender' => $this->gender
        ]);

        session()->flash('success', 'Teacher Created Successfully');

        $this->emit('refresh');

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert-modal');
    }

    public function createSubject(): void
    {
        $this->validate([
            'subject_nm' => 'required|unique:subjects',
            'cost_amt' => 'required'
        ]);

        Subject::create([
            'subject_nm' => $this->subject_nm,
            'cost_amt' => $this->cost_amt,
        ]);

        session()->flash('success', 'Subject Created Successfully');

        $this->emit('refresh');

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert-modal');
    }

    public function updated(): void
    {
        $this->validate([
            'first_nm' => 'string',
            'last_nm' => 'string',
            'dob' => 'before:31-12-1999',
            'phone_nbr' => 'numeric',
            'email' => 'email|unique:users|unique:students',
        ]);
    }

    public function addStudent(): void
    {
        $this->subjectAdd = false;
        $this->teacherAdd = false;

        $this->dispatchBrowserEvent('open-modal');
    }

    public function addSubject(): void
    {
        $this->subjectAdd = true;
        $this->teacherAdd = false;

        $this->dispatchBrowserEvent('open-modal');
    }

    public function addTeacher(): void
    {
        $this->teacherAdd = true;
        $this->subjectAdd = false;

        $this->dispatchBrowserEvent('open-modal');
    }

    public function render()
    {
        $this->dispatchBrowserEvent('open-drop');
        return view('livewire.navigation.admin-navi',[
            'subjects' => Subject::all()
        ])
            ->extends('layouts.admin');
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/');
    }

}
