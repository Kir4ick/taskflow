<?php

namespace App\Services;

use App\Dictionaries\Permissions;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use ReflectionClass;

class RBACService
{

    const ADMIN_ROLE_NAME = 'admin';

    /**
     * Создание админской роли
     *
     * @param User $user
     *
     * @return Role
     */
    public function createAdminRole(User $user): Role
    {
        $role = new Role();
        $role->company_id = $user->company_id;
        $role->title = self::ADMIN_ROLE_NAME;
        $role->save();

        $databasePermissions = Permission::query()
            ->whereIn('title', $this->getAllPermissions())
            ->get();

        /** @var Permission $permission */
        foreach ($databasePermissions as $permission) {
            $permission->roles()->attach($role->id);
        }

        return $role;
    }

    /**
     * Получить все доступные permissions
     *
     * @return array
     */
    private function getAllPermissions(): array
    {
        $reflection = new ReflectionClass(Permissions::class);
        $constants = $reflection->getConstants();

        return array_map(function (\ReflectionClassConstant $item) {
            return $item->getValue();
        }, $constants);
    }

    /**
     * Обновление списка permissions
     *
     * @return void
     */
    public function updatePermissions(): void
    {
        $allPermissions = $this->getAllPermissions();

        foreach ($allPermissions as $permission) {
            $issetPermission = Permission::query()
                ->where('title', $permission)
                ->first();

            if ($issetPermission) {
                continue;
            }

            $permissionModel = new Permission();
            $permissionModel->title = $permission;
            $permissionModel->save();
        }
    }

    public function checkUserPermission(User $user, string $permission): bool
    {
        $roles = $user->roles()->with('permissions')->get();

        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->title === $permission) {
                    return true;
                }
            }
        }

        return false;
    }

}
