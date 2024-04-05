<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends EloquentRepository
{
    protected $model;

    public function model()
    {
        return Category::class;
    }

    public function list(array $data, $select)
    {
        $query = $this->model->select($select);
        if (isset($data['search'])) {
            $query->where('name', 'like', '%' . $data['search'] . '%');
        }
        return $this->paginate($query, $this->handlePaginate($data));
    }
}
