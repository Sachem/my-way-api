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
 * Class HabitCategory
 * 
 * @property int $id
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Habit[] $habits
 *
 * @package App\Models
 */
class HabitCategory extends Model
{
	use SoftDeletes;
	protected $table = 'habit_categories';

	protected $fillable = [
		'name'
	];

	public function habits()
	{
		return $this->hasMany(Habit::class, 'category_id');
	}
}
