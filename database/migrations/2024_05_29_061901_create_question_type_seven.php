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
        Schema::create('question_type_seven', function (Blueprint $table) {
            $table->id();
			$table->integer('branch_id')->nullable();
			$table->integer('subject_id')->nullable();
			$table->integer('lesson_id')->nullable();
			$table->string('question_name')->nullable();
			$table->string('option_a')->nullable();
			$table->string('option_b')->nullable();
			$table->string('option_c')->nullable();
			$table->string('option_d')->nullable();
			$table->string('option_1')->nullable();
			$table->string('option_2')->nullable();
			$table->string('option_3')->nullable();
			$table->string('option_4')->nullable();
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
        Schema::dropIfExists('question_type_seven');
    }
};
