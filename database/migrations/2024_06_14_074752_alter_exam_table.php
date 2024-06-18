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
            
            $table->integer('type')->after('publish_date')->nullable();
			$table->string('suspend_reason')->after('type')->nullable();
			$table->integer('publish_status')->after('suspend_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
			$table->dropColumn('type');
			$table->dropColumn('suspend_reason');
			$table->dropColumn('publish_status');
		});
    }
};
