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
        Schema::create('habits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index('fk_habits_users1_idx');
            $table->unsignedInteger('category_id')->index('fk_habits_habit_categories1_idx');
            $table->string('name', 60)->nullable();
            $table->unsignedInteger('priority')->nullable();
            $table->tinyInteger('measurable')->nullable();
            $table->unsignedInteger('goal')->nullable();
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
        Schema::dropIfExists('habits');
    }
};
