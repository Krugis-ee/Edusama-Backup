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
        Schema::create('question_type_six', function (Blueprint $table) {
            $table->id();
			$table->integer('branch_id')->nullable();
			$table->integer('subject_id')->nullable();
			$table->integer('lesson_id')->nullable();
			$table->string('question_name')->nullable();
			$table->string('complexity')->nullable();
			$table->string('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_type_six');
    }
};
