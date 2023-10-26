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
            $table->foreign(['category_id'], 'fk_habits_habit_categories1')->references(['id'])->on('habit_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'fk_habits_users1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_habits_habit_categories1');
            $table->dropForeign('fk_habits_users1');
        });
    }
};
