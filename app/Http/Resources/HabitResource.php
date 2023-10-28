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

        foreach ([Carbon::today()] as $key => $date) // TODO: addmore dates (see Habit model)
        {
            foreach ($this->progress as $day)
            {
                if ($day->date->toDateString() == $date)
                {
                    $progress[$key] = [
                        'count' => $day->count,
                        'done' => $day->done,
                    ];

                    continue;
                }
            }

            if ( ! isset($progress[$key]))
            {
                $progress[$key] = [
                    'count' => 0,
                    'done' => 0,
                ];
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'priority' => $this->priority,
            'measurable' => $this->measurable,
            'goal' => $this->goal,
            'progress' => $progress,
        ];
    }
}
