<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    public function __construct(
        private readonly UserService $userService
    )
    {}

    public function createCompany(string $companyName, string $email): void
    {
        DB::transaction(function () use ($companyName, $email) {
            $company = new Company();
            $company->title = $companyName;
            $company->save();

            $this->userService->createAdminUser($email, $company->id);
        });
    }
}
