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
 * Class Task
 * 
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Carbon $end_date
 * @property int $type
 * @property int $priority
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $created_by
 * 
 * @property User $user
 * @property Collection|UsersWorked[] $users_workeds
 * @property Collection|TaskFile[] $task_files
 * @property Collection|TaskComment[] $task_comments
 * @property Collection|TaskHistory[] $task_histories
 * @property Collection|TaskTime[] $task_times
 *
 * @package App\Models
 */
class Task extends Model
{
	use SoftDeletes;
	protected $table = 'tasks';

	protected $casts = [
		'end_date' => 'datetime',
		'type' => 'int',
		'priority' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'end_date',
		'type',
		'priority',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function users_workeds()
	{
		return $this->hasMany(UsersWorked::class);
	}

	public function task_files()
	{
		return $this->hasMany(TaskFile::class);
	}

	public function task_comments()
	{
		return $this->hasMany(TaskComment::class);
	}

	public function task_histories()
	{
		return $this->hasMany(TaskHistory::class);
	}

	public function task_times()
	{
		return $this->hasMany(TaskTime::class);
	}
}
