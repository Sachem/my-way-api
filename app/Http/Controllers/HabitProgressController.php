<?php

namespace App\Http\Controllers;

use App\Models\HabitDay;
use App\Models\Habit;
use Illuminate\Http\Request;

class HabitProgressController extends Controller
{
    /**
     * Mark Habit as completed / not completed for the day
     */
    public function markCompleted(Request $request, Habit $habit)
    {
        //
    }

    /**
     * Add progress for the Habit for the day
     */
    public function changeProgress(Request $request, Habit $habit)
    {
        //
    }

}
