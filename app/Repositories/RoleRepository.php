<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends EloquentRepository
{

    public function model()
    {
        return Role::class;
    }

    public function list(array $data, $select)
    {
        $query = $this->model->select($select);
        return $this->paginate($query, $this->handlePaginate($data));
    }

    public function getList()
    {
       return $this->model->select('*')->orderBy('id', 'asc')->get();
    }
    public function getRole($role_id)
    {
        return $this->model->select('*')->whereIn('id', $role_id ?? [])->get();
    }
}
