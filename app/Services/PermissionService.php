<?php

namespace App\Services;

use App\Models\Permission;
use App\Repositories\GroupPermissionRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;

class PermissionService
{
    protected $permissionRepository;
    protected $roleRepository;

    protected $groupPermissionRepository;

    public function __construct
    (
        PermissionRepository $permissionRepository,
        RoleRepository $roleRepository,
        GroupPermissionRepository $groupPermissionRepository
    )
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
        $this->groupPermissionRepository = $groupPermissionRepository;
    }

    public function list($params, $select = '*')
    {
        $permissions = collect([]);
        try {
            $permissions = $this->groupPermissionRepository->list($params, $select);
        } catch (\Throwable $e) {
            report($e);
        }

        return [
            'permissions' => $permissions,
            'itemStart' => $permissions->firstItem(),
        ];
    }

    public function getListPermissionByGroup($id)
    {
        $permissions = collect([]);
        try {
            $permissions = $this->permissionRepository->getListPermissionByGroup($id);
        } catch (\Throwable $e) {
            report($e);
        }
        return $permissions;
    }

    public function setPermission($params, $id): mixed
    {
        try {
            $permission = $this->permissionRepository->find($id);
            if ($permission) {
                // Get the roles
                $role_id = $params['role_id'];
                $roles = $this->roleRepository->getRole($role_id);

                app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

                // Sync the roles with the permission
                return $permission->roles()->sync($roles);
            }
        } catch (\Throwable $e) {
            report($e);
        }
        return false;
    }
}
