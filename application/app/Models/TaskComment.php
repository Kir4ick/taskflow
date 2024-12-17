<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskComment
 * 
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $comment
 * 
 * @property User $user
 * @property Task $task
 *
 * @package App\Models
 */
class TaskComment extends Model
{
	protected $table = 'task_comments';

	protected $casts = [
		'user_id' => 'int',
		'task_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'task_id',
		'comment'
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
