<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends EloquentRepository
{
    protected $model;

    public function model()
    {
        return Product::class;
    }

    public function list(array $data, $select)
    {
        $query = $this->model
            ->with('category')
            ->select($select);
        if (isset($data['search'])) {
            $query->where('name', 'like', '%' . $data['search'] . '%');
        }
        return $this->paginate($query, $this->handlePaginate($data));
    }
}
