<?php

namespace App\Services;

use App\Models\Dashboard;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function list(int $companyId): Collection
    {
        return Dashboard::query()
            ->where('company_id', $companyId)
            ->get();
    }

    public function create(string $title, string $description, int $companyId): Dashboard
    {
        $dashboard = new Dashboard();
        $dashboard->title = $title;
        $dashboard->description = $description;
        $dashboard->company_id = $companyId;

        $dashboard->save();

        return $dashboard;
    }
}
