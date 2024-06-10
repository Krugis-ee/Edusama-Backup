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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
			$table->integer('class_room_id')->nullable();
			$table->integer('subject_id')->nullable();
			$table->string('lesson_ids')->nullable();
			$table->string('exam_name')->nullable();
			$table->string('total_marks')->nullable();
			$table->string('passing_mark')->nullable();
			$table->string('duration')->nullable();
			$table->string('exam_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam');
    }
};
