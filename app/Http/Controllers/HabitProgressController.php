<?php

namespace App\Http\Controllers;

use App\Models\HabitDay;
use App\Models\Habit;
use App\Http\Resources\HabitResource;
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

        return response()->json(new HabitResource($habit), 200);
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

        HabitDay::updateOrCreate(
            ['habit_id' => $habit->id, 'date' => $request->date],
            [
                'progress' => $request->progress,
                'done' => $request->progress >= $habit->goal ? 1 : 0,
            ]
        );
        
        return response()->json(new HabitResource($habit), 200);
    }

}
