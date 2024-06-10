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
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
			$table->integer('organisation_id')->nullable();
            
			$table->integer('branch_id')->nullable();
			$table->integer('template_id')->nullable();
			$table->string('class_room_name')->nullable();            
            $table->string('duration')->nullable();
			$table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
			$table->integer('type')->nullable();
			
            $table->string('offline_course_module')->nullable();
            $table->string('quiz_exam_module')->nullable();
            $table->string('assessment_course_module')->nullable();
            $table->string('library_module')->nullable();
            $table->string('attendance_module')->nullable();
            $table->string('online_course_module')->nullable();
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};
