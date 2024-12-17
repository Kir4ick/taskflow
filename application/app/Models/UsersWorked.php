<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersWorked
 * 
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property Carbon $start_work_time
 * @property Carbon $end_work_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Task $task
 *
 * @package App\Models
 */
class UsersWorked extends Model
{
	protected $table = 'users_worked';

	protected $casts = [
		'user_id' => 'int',
		'task_id' => 'int',
		'start_work_time' => 'datetime',
		'end_work_time' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'task_id',
		'start_work_time',
		'end_work_time'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function task()
	{
		return $this->belongsTo(Task::class);
	}
}
