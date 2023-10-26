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
        Schema::create('habit_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habit_id')->index('fk_habit_days_habits_idx');
            $table->date('date')->nullable();
            $table->unsignedInteger('count')->nullable();
            $table->tinyInteger('done')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habit_days');
    }
};
