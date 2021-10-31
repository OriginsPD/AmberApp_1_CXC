<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminReport extends Component
{
    public $tabOne = true;
    public $tabTwo = false;
    public $tabthree = false;

    public function tabsControl($value)
    {
        if ($value === 1) {

            $this->dispatchBrowserEvent('tab-one');

        }
        elseif ($value === 2) {

            $this->dispatchBrowserEvent('tab-two');

        }
        elseif ($value === 3) {

            $this->dispatchBrowserEvent('tab-three');

        }
    }

    public function render()
    {
        return view('livewire.admin.admin-report')
            ->extends('layouts.admin');
    }
}
