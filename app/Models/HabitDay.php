<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HabitDay
 * 
 * @property int $id
 * @property int $habit_id
 * @property Carbon|null $date
 * @property int|null $count
 * @property int|null $done
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Habit $habit
 *
 * @package App\Models
 */
class HabitDay extends Model
{
	use SoftDeletes;
	protected $table = 'habit_days';

	protected $casts = [
		'habit_id' => 'int',
		'date' => 'datetime',
		'count' => 'int',
		'done' => 'int'
	];

	protected $fillable = [
		'habit_id',
		'date',
		'count',
		'done'
	];

	public function habit()
	{
		return $this->belongsTo(Habit::class);
	}
}
