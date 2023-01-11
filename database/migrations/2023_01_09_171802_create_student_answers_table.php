<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->char('uqid', 10)->unique();
            $table->integer('fk_student_id');
            $table->integer('fk_question_id');
            $table->integer('score')->default(null);
            $table->json('answers')->default(null);
            $table->enum('status', [0, 1])->default(0); //0 => Question not attempted, 1 => Question has been attempetd
            $table->timestamps();
            $table->index('fk_student_id');
            $table->index('fk_question_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_answers');
    }
}
