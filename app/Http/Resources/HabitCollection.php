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

        $i = 0;
        $finalDateString = Carbon::now()->subDays(15)->toDateString();
        $date = Carbon::now();

        while ($date->toDateString() != $finalDateString) 
        {
            $dates[$i] = [
                'date' => $date->toDateString(),
                'dayOfWeek' => $date->shortEnglishDayOfWeek,
                'dayInMonth' => $date->day,
            ];

            $i++;
            $date->subDay();        
        }

        return [
            'meta' => [
                'dates' => $dates,
            ]
        ];
    }

}
