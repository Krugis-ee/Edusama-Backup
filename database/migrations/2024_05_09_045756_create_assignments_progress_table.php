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
        Schema::create('assignments_progress', function (Blueprint $table) {
            $table->id();
			$table->integer('assignment_id')->nullable();
			$table->integer('student_id')->nullable();
			$table->integer('assignment_download_status')->default(0);
			$table->integer('answer_upload_status')->default(0);
			$table->string('answer_pdf')->nullable();
			$table->integer('answer_sent_status')->default(0);
			$table->integer('answer_response_status')->default(0);
			$table->string('answer_submitted_date')->nullable();
			$table->integer('score')->nullable();
			$table->string('score_comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments_progress');
    }
};
