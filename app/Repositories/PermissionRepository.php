<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends EloquentRepository
{
    protected $model;
    public function model()
    {
        return Permission::class;
    }

    public function getListPermissionByGroup($id)
    {
        return $this->model->where('group_id', '=', $id)->orderBy('order')->get();
    }
}
