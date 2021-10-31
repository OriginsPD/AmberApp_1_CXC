<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'first_nm',
        'last_nm',
        'dob',
        'class',
        'phone_nbr',
        'email',
        'gender',
    ];

    public function subjectChoice(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SubjectChoice::class, 'student_id')->with('subjects');
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class,'student_id');
    }

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class,'student_id');
    }
}
