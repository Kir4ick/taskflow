<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RolesPermission
 * 
 * @property int $id
 * @property int $permission_id
 * @property int $role_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Permission $permission
 * @property Role $role
 *
 * @package App\Models
 */
class RolesPermission extends Model
{
	protected $table = 'roles_permissions';

	protected $casts = [
		'permission_id' => 'int',
		'role_id' => 'int'
	];

	protected $fillable = [
		'permission_id',
		'role_id'
	];

	public function permission()
	{
		return $this->belongsTo(Permission::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}
}
