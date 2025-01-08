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
 * @property Collection|UsersWorked[] $usersWorkers
 * @property Collection|TaskFile[] $taskFiles
 * @property Collection|TaskComment[] $taskComments
 * @property Collection|TaskHistory[] $taskHistories
 * @property Collection|TaskTime[] $taskTimes
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

	public function usersWorkeds()
	{
		return $this->hasMany(UsersWorked::class);
	}

	public function taskFiles()
	{
		return $this->hasMany(TaskFile::class);
	}

	public function taskComments()
	{
		return $this->hasMany(TaskComment::class);
	}

	public function taskHistories()
	{
		return $this->hasMany(TaskHistory::class);
	}

	public function taskTimes()
	{
		return $this->hasMany(TaskTime::class);
	}
}
