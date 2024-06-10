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
        Schema::create('class_room_timings', function (Blueprint $table) {
            $table->id();
			$table->integer('class_room_id')->nullable();
            $table->string('weakday')->nullable();
            $table->string('from_time')->nullable();
            $table->string('to_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_room_timings');
    }
};
