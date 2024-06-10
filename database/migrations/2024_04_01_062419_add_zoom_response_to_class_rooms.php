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
        Schema::table('class_rooms', function (Blueprint $table) {
            $table->text('zoom_topic')->nullable();
			$table->integer('zoom_type')->nullable();
			$table->text('zoom_start_url')->nullable();
			$table->text('zoom_join_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_rooms', function (Blueprint $table) {
            //
        });
    }
};
