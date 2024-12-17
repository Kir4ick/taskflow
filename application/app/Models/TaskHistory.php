<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskHistory
 * 
 * @property int $id
 * @property int $status_id
 * @property int $task_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property DashboardStatus $dashboard_status
 * @property Task $task
 * @property User $user
 *
 * @package App\Models
 */
class TaskHistory extends Model
{
	protected $table = 'task_history';

	protected $casts = [
		'status_id' => 'int',
		'task_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'status_id',
		'task_id',
		'user_id'
	];

	public function dashboard_status()
	{
		return $this->belongsTo(DashboardStatus::class, 'status_id');
	}

	public function task()
	{
		return $this->belongsTo(Task::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
