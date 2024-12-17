<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskTime
 * 
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $hours
 * 
 * @property Task $task
 * @property User $user
 *
 * @package App\Models
 */
class TaskTime extends Model
{
	protected $table = 'task_times';

	protected $casts = [
		'task_id' => 'int',
		'user_id' => 'int',
		'hours' => 'int'
	];

	protected $fillable = [
		'task_id',
		'user_id',
		'hours'
	];

	public function task()
	{
		return $this->belongsTo(Task::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
