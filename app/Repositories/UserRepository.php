<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends EloquentRepository
{

    protected $model;


    public function model()
    {
        return User::class;
    }

    public function exist($column, $condition)
    {
        return $this->model->where($column, $condition)->first();
    }

    public function list(array $data, $select)
    {
        $query = $this->model
            ->role('admin')
            ->select($select);
        if (isset($data['search'])) {
            $query->where('name', 'like', '%' . $data['search'] . '%');
        }
        return $this->paginate($query, $this->handlePaginate($data));
    }

}
