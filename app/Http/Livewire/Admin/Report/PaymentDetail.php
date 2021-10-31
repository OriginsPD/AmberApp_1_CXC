<?php

namespace App\Http\Livewire\Admin\Report;

use App\Models\Payment;
use Livewire\Component;

class PaymentDetail extends Component
{
    public function render()
    {
        return view('livewire.admin.report.payment-detail', [

            'paymentSum' => Payment::with('students')->groupBy('student_id')
                ->selectRaw('sum(amount_paid) as sum, student_id, sum(balance_amt) as balance_amt, student_id',)
                ->get(),

            'paymentAvg' => Payment::with('students')->groupBy('student_id')
                ->selectRaw('avg(amount_paid) as Avg, student_id, avg(balance_amt) as balance_amt, student_id',)
                ->get()

        ]);
    }
}
