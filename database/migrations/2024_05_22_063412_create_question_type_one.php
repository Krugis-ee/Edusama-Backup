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
        Schema::create('question_type_one', function (Blueprint $table) {
            $table->id();
			$table->integer('class_room_id');
			$table->integer('subject_id');
			$table->integer('lession_id');
			$table->string('question_name');
			$table->string('option_a');
			$table->string('option_b');
			$table->string('option_c');
			$table->string('option_d');
			$table->string('complexity');
			$table->string('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_type_one');
    }
};
