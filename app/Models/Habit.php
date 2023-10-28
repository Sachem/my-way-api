<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Habit
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int $category_id
 * @property string|null $name
 * @property string|null $priority
 * @property int|null $measurable
 * @property int|null $goal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property HabitCategory $habit_category
 * @property User|null $user
 * @property Collection|HabitDay[] $habit_days
 *
 * @package App\Models
 */
class Habit extends Model
{
	use SoftDeletes;
	protected $table = 'habits';

	protected $casts = [
		'user_id' => 'int',
		'category_id' => 'int',
		'measurable' => 'int',
		'goal' => 'int'
	];

	protected $fillable = [
		'category_id',
		'name',
		'priority',
		'measurable',
		'goal'
	];

	public function habit_category()
	{
		return $this->belongsTo(HabitCategory::class, 'category_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function habit_days()
	{
		return $this->hasMany(HabitDay::class);
	}

	public function progress() {  // TODO: add more dates
        // return $this->habit_days()->where('date','=', Carbon::today()->toDateString());
        return $this->habit_days();
    }
}
