<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $title
 * @property int $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Collection|Permission[] $permissions
 * @property Collection|User[] $users
 * @property Collection|DashboardStatus[] $dashboard_statuses
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';

	protected $casts = [
		'company_id' => 'int'
	];

	protected $fillable = [
		'title',
		'company_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'roles_permissions')
					->withPivot('id')
					->withTimestamps();
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'users_roles')
					->withPivot('id')
					->withTimestamps();
	}

	public function dashboard_statuses()
	{
		return $this->hasMany(DashboardStatus::class, 'work_role_id');
	}
}
