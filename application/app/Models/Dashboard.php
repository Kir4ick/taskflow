<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dashboard
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $company_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Company $company
 * @property Collection|DashboardStatus[] $dashboard_statuses
 *
 * @package App\Models
 */
class Dashboard extends Model
{
	use SoftDeletes;
	protected $table = 'dashboards';

	protected $casts = [
		'company_id' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'company_id'
	];

	public function company(): BelongsTo
	{
		return $this->belongsTo(Company::class);
	}

	public function dashboardStatuses(): HasMany
	{
		return $this->hasMany(DashboardStatus::class);
	}
}
