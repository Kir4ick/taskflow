<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\RBACService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionMiddleware
{

    public function __construct(
        private readonly RBACService $rbacService,
    )
    {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $needPermission): Response
    {
        /** @var User $user */
        $user = Auth::user();

        $permissionExist = $this->rbacService->checkUserPermission($user, $needPermission);

        if (!$permissionExist) {
            session()->flash('message', 'У вас недостаточно прав для данного действия');
            return redirect()->back();
        }

        return $next($request);
    }
}
