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
}
