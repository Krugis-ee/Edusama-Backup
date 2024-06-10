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
        Schema::table('question_type_three_temp', function (Blueprint $table) {
            
            $table->string('choice_1')->after('option_4')->nullable();;
			$table->string('choice_2')->after('choice_1')->nullable();
			$table->string('choice_3')->after('choice_2')->nullable();
			$table->string('choice_4')->after('choice_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('question_type_three_temp', function (Blueprint $table) {
		$table->dropColumn('choice_1');
		$table->dropColumn('choice_2');
		$table->dropColumn('choice_3');
		$table->dropColumn('choice_4');
		});
    }
};
