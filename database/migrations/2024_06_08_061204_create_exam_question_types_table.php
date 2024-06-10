<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_question_types', function (Blueprint $table) {
            $table->id();
			$table->integer('exam_id')->nullable();
			$table->integer('lesson_id')->nullable();
			$table->string('question_type')->nullable();
			$table->string('difficulty_level')->nullable();
			$table->string('no_of_questions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_question_types');
    }
};
