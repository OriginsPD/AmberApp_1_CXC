<?php

namespace App\Http\Livewire\Admin\Report;

use App\Models\PaymentHistory;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentLog extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.report.payment-log',[
            'payHistories' => PaymentHistory::with('students')
                ->paginate(5)
        ]);
    }
}
