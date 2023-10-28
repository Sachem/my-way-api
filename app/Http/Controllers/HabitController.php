<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HabitRequest;
use App\Http\Resources\HabitResource;
use App\Http\Resources\HabitCollection;
use App\Models\Habit;
use App\Models\HabitCategory;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habits = Habit::with('progress')
            ->where('user_id', auth()->user()->id)
            ->get();
        
        return new HabitCollection($habits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HabitRequest $request)
    {
        $validated = $request->validated();

        $habit = new Habit;
        $habit->user_id = auth()->user()->id;
        $habit->category_id = $validated['category_id'];
        $habit->name = $validated['name'];
        $habit->measurable = $validated['measurable'];
        $habit->goal = $validated['goal'] ?? NULL;
        $habit->save();

        $habit->load('progress');

        return response()->json(new HabitResource($habit), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Habit $habit)
    {
        return response()->json(
            new HabitResource($habit), 
        200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HabitRequest $request, Habit $habit)
    {
        $input = $request->all();
        $habit->fill($input)->save();

        return response()->json($habit, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Habit $habit)
    {
        if (! $request->user()->can('delete', $habit))
        {
            return response()->json('Unauthorized', 401);
        }

        $habit->delete();

        return response()->json('OK', 200);
    }

    /**
     * Display a listing of habt categories.
     */
    public function categories()
    {
        $categories = HabitCategory::all();
        
        return response()->json($categories, 200);
        
    }
}
