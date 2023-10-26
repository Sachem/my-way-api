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
        Schema::table('habit_days', function (Blueprint $table) {
            $table->foreign(['habit_id'], 'fk_habit_days_habits')->references(['id'])->on('habits')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('habit_days', function (Blueprint $table) {
            $table->dropForeign('fk_habit_days_habits');
        });
    }
};
