<?php

namespace App\Http\Livewire\Auth;

use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeacherPortal extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:4'
    ];

    public function storeLogin()
    {
        $this->validate();

        if (auth()->attempt($this->validate())) {

            $isApprove = Teacher::where('email', $this->email)
                ->where('status', 1)
                ->exists();

            if ($isApprove) {

                $subject = Teacher::where('email', $this->email)
                    ->first();

                session()->put('subject_id',$subject->subject_id);

                session()->put('role', auth()->user()->isAdmin);

                return back();
            }

            $this->addError('email', 'Teacher To Be Approved Please Contact Admin');

            Auth::logout();

            session()->invalidate();

            session()->regenerateToken();

            $this->redirect(route('teacher.dashboard'));

        }

        $this->addError('email', trans('auth.failed'));
    }

    public function updated(): void
    {
        $this->validate([
            'email' => 'email',
            'password' => 'min:4'
        ]);
    }

    public function render()
    {
        return view('livewire.auth.teacher-portal')->extends('layouts.app');
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/');
    }
}
