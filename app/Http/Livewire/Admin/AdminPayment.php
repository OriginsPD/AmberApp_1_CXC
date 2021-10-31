<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use App\Models\PaymentHistory;
use App\Models\Students;
use App\Models\Subject;
use App\Models\SubjectChoice;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPayment extends Component
{
    use WithPagination;

    public $student_id;
    public $subject_id;

    public $subject;

    public $amount_paid;

    public $payments = [];
    public $transaction = [];

    public $paymentAdd = true;

    protected $rules = [
        'student_id' => 'required',
        'subject_id' => 'required',
    ];

    public function storePayment(): void
    {
        $this->validate();

        $isApprove = SubjectChoice::where([
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
            'status' => 1,
        ])->exists();

        if ($isApprove) {

            $isAdded = Payment::where([
                'student_id' => $this->student_id,
                'subject_id' => $this->subject_id,
            ])->exists();

            if (!$isAdded){

                $studentInfo = SubjectChoice::with('subjects', 'students')->where([
                    'student_id' => $this->student_id,
                    'subject_id' => $this->subject_id,
                ])->get()->first();

                Payment::create([
                    'student_id' => $this->student_id,
                    'subject_id' => $this->subject_id,
                    'amount_paid' => 0,
                    'balance_amt' => $studentInfo->subjects->cost_amt,
                ]);

                Transaction::create([
                    'student_id' => $this->student_id,
                    'amount_due' => $studentInfo->subjects->cost_amt,
                    'amount_paid' => 0,
                    'balance_amt' => $studentInfo->subjects->cost_amt,
                    'year_of_exam' => $studentInfo->year_of_exam,
                ]);

                session()->flash('success', 'Payment Created Successfully');

                $this->amount_paid = '';

                $this->dispatchBrowserEvent('alert-modal');
                $this->dispatchBrowserEvent('close-modal');


            }

            $this->addError('student_id', 'Student Already Been Added');

        }

        $this->addError('student_id', 'Student As Not Been Approved As Yet');

    }

    public function storeUpdatePay(): void
    {
        $this->validate(['amount_paid' => 'required|numeric']);


        $trans = Transaction::where('id', $this->payments->id)->get();


        $newAmount = $trans[0]->balance_amt - $this->amount_paid;
        $balance = $trans[0]->amount_paid +  $this->amount_paid;


        if ($newAmount >= 0) {
            Transaction::where('id', $this->payments->id)
                ->update([
                    'amount_paid' => $balance,
                    'balance_amt' => $newAmount,
                ]);

            Payment::where('id', $this->payments->id)
                ->update([
                    'amount_paid' => $balance,
                    'balance_amt' => $newAmount,
                    'date_paid' => date('Y-m-d')
                ]);

            $desc = 'A Payment of $' . $this->amount_paid . ' was made on the subject of ' . $this->payments->subjects->subject_nm;

            PaymentHistory::create([
                'student_id' => $trans[0]->student_id,
                'amount_paid' => $this->amount_paid,
                'date_paid' => date('Y-m-d'),
                'description' => $desc,
            ]);

            $this->amount_paid = '';

            $this->dispatchBrowserEvent('alert-modal');
        }
        else{

            $this->addError('amount_paid', 'Amount Paid Have Passed Amount Due');
        }

    }

    public function addPayment(): void
    {
        $this->paymentAdd = true;

        $this->dispatchBrowserEvent('show-modal');
    }

    public function makePayment(Payment $payment): void
    {
        $this->paymentAdd = false;

        $this->payments = Payment::with('students', 'subjects')
            ->where('id', $payment->id)
            ->first();

        $this->transaction = Transaction::with('students')
            ->where('id', $payment->id)
            ->first();



        $this->dispatchBrowserEvent('show-modal');
    }

    public function updated(): void
    {
        $this->validate();

    }

    public function updatedPayments(): void
    {
        if(isset($this->payments->id)){
            $this->payments = Payment::with('students', 'subjects')
                ->where('id', $this->payments->id)
                ->first();

            $this->transaction = Transaction::with('students')
                ->where('id', $this->payments->id)
                ->first();
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-payment', [
            'infoPayments' => Payment::with('students', 'subjects')->orderBy('student_id')->paginate(5),
            'students' => Students::all(),
            'subjects' => Subject::all(),

        ])
            ->extends('layouts.admin');
    }
}
