<?php

namespace App\Http\Livewire\Navigation;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeacherNavi extends Component
{
    public function render()
    {
        return view('livewire.navigation.teacher-navi');
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/');
    }
}
