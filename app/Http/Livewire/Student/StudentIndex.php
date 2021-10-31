<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class StudentIndex extends Component
{
    public function render()
    {
        return view('livewire.student.student-index')
            ->extends('layouts.admin');
    }
}
