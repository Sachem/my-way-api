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

        foreach ($this->progress as $day)
        {
            $progress[$day->date->toDateString()] = [
                'count' => $day->count,
                'done' => $day->done,
            ];
        }

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'priority' => $this->priority,
            'measurable' => $this->measurable,
            'goal' => $this->goal,
            'progress' => $progress,
        ];
    }
}
