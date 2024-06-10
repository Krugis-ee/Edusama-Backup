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
        Schema::table('assignments_progress', function (Blueprint $table) {
            
            $table->integer('reupload_status')->after('score_comment')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignments_progress', function (Blueprint $table) {
			$table->dropColumn('reupload_status');
		});
    }
};
