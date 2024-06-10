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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
			$table->string('title')->nullable();
			$table->integer('subject_id')->nullable();
			$table->string('delivery_date')->nullable();
			$table->string('assignment_pdf')->nullable();
			$table->integer('class_room_id')->nullable();
			$table->integer('teacher_id')->nullable();
			$table->integer('publish_status')->default(0);
			$table->string('publish_date')->nullable();	
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
