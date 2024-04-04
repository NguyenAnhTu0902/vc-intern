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

}
