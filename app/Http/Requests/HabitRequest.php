<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HabitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // store
        if (request()->isMethod('post')) 
        {
            return true;
        }
    
        // update
        return $this->user()->can('update', $this->habit);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'category_id' => 'exists:habit_categories,id',
            'name' => 'required|max:60',
            'measurable' => 'required|integer',
        ];

        if (request()->input('measurable') == 1) 
        {
            $rules['goal'] = 'required|integer|gt:0';
        }

        return $rules;
    }
}
