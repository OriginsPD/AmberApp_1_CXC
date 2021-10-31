<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'subject_id',
        'amount_paid',
        'balance_amt',
        'date_paid',
    ];

    public function students(): BelongsTo
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function subjects(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function transactions(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,'id');
    }
}
