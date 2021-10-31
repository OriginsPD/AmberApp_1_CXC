<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('subject_choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students','id');
            $table->foreignId('subject_id')->constrained('subjects','id');
            $table->boolean('status')->default(null)->nullable();
            $table->year('year_of_exam');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_choices');
    }
}
