<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $company_id
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Company $company
 * @property Collection|Role[] $roles
 * @property Collection|Task[] $tasks
 * @property Collection|UsersWorked[] $users_workeds
 * @property Collection|TaskFile[] $task_files
 * @property Collection|TaskComment[] $task_comments
 * @property Collection|TaskHistory[] $task_histories
 * @property Collection|TaskTime[] $task_times
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'users';

	protected $casts = [
		'company_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'company_id',
		'password',
		'remember_token'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'users_roles')
					->withPivot('id')
					->withTimestamps();
	}

	public function tasks()
	{
		return $this->hasMany(Task::class, 'created_by');
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
