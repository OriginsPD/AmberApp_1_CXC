<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        return view('livewire.home.homepage')
            ->extends('layouts.app');
    }
}
