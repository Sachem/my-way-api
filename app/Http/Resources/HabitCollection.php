<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;

class HabitCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

     /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        $dates = [];

        foreach ([Carbon::today()] as $key => $date) // TODO: add more dates (see Habit model)
        {
            $dates[$key] = $date->toDateString();

        }

        return [
            'meta' => [
                'dates' => $dates,
            ]
        ];
    }

}
