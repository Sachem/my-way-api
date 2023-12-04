<?php

namespace App\Http\Controllers;

use App\Models\HabitDay;
use App\Models\Habit;
use App\Http\Resources\HabitResource;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    /**
     * load progress for a habit for a specified period
     */
    public function loadProgress(Request $request, Habit $habit)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->startDate); // first day of the month the user navigated to
        $from = $startDate->subDays(7)->toDateString(); // I want to get progress for the week preceeding first day, because React calendar plugin fills the row with last days of the previous month
        $to = $startDate->addDays(37)->toDateString(); // load until the last day of the month

        $progress = HabitDay::where('habit_id', $habit->id)
                            ->where('date','>=', $from)
					        ->where('date','<=', $to)
                            ->get();
        
        $return = [];
        if ( ! empty($progress))
        {
            foreach ($progress as $item)
            {
                $return[] = [
                    'progress' => $item->progress,
                    'done' => $item->done,
                    'date' => convertPhpDateToJavaScript($item->date),
                ];
            }
        }

        return response()->json($return, 200);
    }
}
