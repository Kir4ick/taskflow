<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskFile
 * 
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $path
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Task $task
 *
 * @package App\Models
 */
class TaskFile extends Model
{
	protected $table = 'task_files';

	protected $casts = [
		'user_id' => 'int',
		'task_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'task_id',
		'path',
		'name'
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
