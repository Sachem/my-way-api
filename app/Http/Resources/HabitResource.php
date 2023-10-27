<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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

        foreach (['2023-10-27'] as $date) // TODO: hardcoded
        {
            foreach ($this->progress as $day)
            {
                if ($day->date->toDateString() == $date)
                {
                    $progress[$date] = [
                        'count' => $day->count,
                        'done' => $day->done,
                    ];

                    continue;
                }
            }

            if ( ! isset($progress[$date]))
            {
                $progress[$date] = [
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
