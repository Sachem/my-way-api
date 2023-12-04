<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class HabitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $progress = [];

        $i = 0;
        $finalDateString = Carbon::now()->subDays(config('habits.recent_progress_days_count'))->toDateString();
        $date = Carbon::now();
        $dateString = $date->toDateString();

        while ($dateString != $finalDateString) 
        {
            if ($this->recent_progress !== null)
            {
                foreach ($this->recent_progress as $day)
                {
                    if ($day->date == $dateString)
                    {
                        $progress[$i] = [
                            'progress' => $day->progress,
                            'done' => $day->done,
                            'date' => convertPhpDateToJavaScript($dateString),
                        ];

                        continue;
                    }
                }
            }

            if ( ! isset($progress[$i]))
            {
                $progress[$i] = [
                    'progress' => 0,
                    'done' => 0,
                    'date' => convertPhpDateToJavaScript($dateString),
                ];
            }

            $i++;
            $date->subDay();
            $dateString = $date->toDateString();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'priority' => $this->priority,
            'measurable' => $this->measurable,
            'goal' => $this->goal,
            'unit_id' => $this->unit_id,
            'unit' => $this->unit_id ? $this->habit_unit->name : null,
            'progress' => $progress,
        ];
    }
}
