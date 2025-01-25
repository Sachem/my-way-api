<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('habits', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign('fk_habits_habit_units1');
        });

        Schema::table('habits', function (Blueprint $table) {
            // Modify the column to allow NULL
            $table->unsignedInteger('unit_id')->nullable()->change();

            // Recreate the foreign key constraint
            $table->foreign('unit_id', 'fk_habits_habit_units1')
                ->references('id')
                ->on('habit_units')
                ->onDelete('cascade'); // Adjust cascade behavior if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('habits', function (Blueprint $table) {
            // Drop the newly created foreign key
            $table->dropForeign('fk_habits_habit_units1');
        });

        Schema::table('habits', function (Blueprint $table) {
            // Revert the column to not allow NULL
            $table->unsignedInteger('unit_id')->nullable(false)->change();

            // Recreate the original foreign key
            $table->foreign('unit_id', 'fk_habits_habit_units1')
                ->references('id')
                ->on('habit_units')
                ->onDelete('cascade'); // Adjust cascade behavior if it was part of the original constraint
        });
    }
};
