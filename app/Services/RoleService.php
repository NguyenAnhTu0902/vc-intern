<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Illuminate\Support\Collection;

class RoleService
{

    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = collect([]);

        try {
            $roles = $this->roleRepository->getList();
        } catch (\Throwable $e) {
            report($e);
        }
        return $roles;
    }

}
