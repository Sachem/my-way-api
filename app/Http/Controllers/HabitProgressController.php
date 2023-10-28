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
        if ($habit->measurable)
        {
            return response()->json('Forbidden', 403);
        }

        HabitDay::updateOrCreate(
            ['habit_id' => $habit->id, 'date' => $request->date],
            ['done' => $request->done]
        );

        return response()->json('OK', 200);
    }

    /**
     * Add progress for the Habit for the day
     */
    public function changeProgress(Request $request, Habit $habit)
    {
        if ( ! $habit->measurable)
        {
            return response()->json('Forbidden', 403);
        }
        
        return response()->json('OK', 200);
    }

}
