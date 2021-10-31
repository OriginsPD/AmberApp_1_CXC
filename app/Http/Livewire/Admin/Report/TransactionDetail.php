<?php

namespace App\Http\Livewire\Admin\Report;

use App\Models\Transaction;
use Livewire\Component;

class TransactionDetail extends Component
{
    public function render()
    {
        return view('livewire.admin.report.transaction-detail',[

            'transactions' => Transaction::with('students','payments')
                ->get(),
        ])->extends('layouts.admin');
    }
}
