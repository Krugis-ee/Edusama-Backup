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
         Schema::table('exams', function (Blueprint $table) {
            
            $table->string('exam_end_date')->after('exam_type')->nullable();
			$table->string('publish_date')->after('exam_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
			$table->dropColumn('exam_end_date');
			$table->dropColumn('publish_date');
		});
    }
};
