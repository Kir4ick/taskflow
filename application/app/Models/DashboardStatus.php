<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DashboardStatus
 * 
 * @property int $id
 * @property string $name
 * @property bool $is_end_process
 * @property int $dashboard_id
 * @property int $work_role_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Dashboard $dashboard
 * @property Role $role
 * @property Collection|TaskHistory[] $task_histories
 *
 * @package App\Models
 */
class DashboardStatus extends Model
{
	protected $table = 'dashboard_statuses';

	protected $casts = [
		'is_end_process' => 'bool',
		'dashboard_id' => 'int',
		'work_role_id' => 'int'
	];

	protected $fillable = [
		'name',
		'is_end_process',
		'dashboard_id',
		'work_role_id'
	];

	public function dashboard()
	{
		return $this->belongsTo(Dashboard::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'work_role_id');
	}

	public function task_histories()
	{
		return $this->hasMany(TaskHistory::class, 'status_id');
	}
}
