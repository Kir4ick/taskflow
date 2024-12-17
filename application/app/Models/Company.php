<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 *
 * @property int $id
 * @property string $title
 * @property string $additional_data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|User[] $users
 * @property Collection|Role[] $roles
 * @property Collection|Dashboard[] $dashboards
 *
 * @package App\Models
 */
class Company extends Model
{
	use SoftDeletes;
	protected $table = 'companies';

	protected $casts = [
		'additional_data' => 'binary'
	];

	protected $fillable = [
		'title',
		'additional_data'
	];

	public function users(): HasMany
	{
		return $this->hasMany(User::class);
	}

	public function roles(): HasMany
	{
		return $this->hasMany(Role::class);
	}

	public function dashboards(): HasMany
	{
		return $this->hasMany(Dashboard::class);
	}
}
