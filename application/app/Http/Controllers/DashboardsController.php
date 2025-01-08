<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboards\CreateDashboardRequest;
use App\Services\DashboardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

final readonly class DashboardsController
{

    public function __construct(
        private DashboardService $dashboardService,
    )
    {}

    public function index(): Response
    {
        $companyId = Auth::user()->company_id;

        return Inertia::render('views/Dashboards', [
            'list' => $this->dashboardService->list($companyId),
        ]);
    }

    public function create(CreateDashboardRequest $request): RedirectResponse
    {
        $companyId = Auth::user()->company_id;

        $this->dashboardService->create(
            $request->post('title'),
            $request->post('description'),
            $companyId
        );

        return redirect(route('dashboard.index'));
    }


}
