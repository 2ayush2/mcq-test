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
            $table->string('code', 36)->unique();
            $table->integer('fk_student_id');
            $table->integer('fk_question_id');
            $table->integer('score')->nullable()->default(null);
            $table->json('answers')->nullable()->default(null);
            $table->enum('status', ['p', 'a', 'c'])->default('p'); //p => Test not attempted, a => Test has been attempetd, c=> Test completed
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
