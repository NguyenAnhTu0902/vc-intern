<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends EloquentRepository
{

    protected $model;

    public function model()
    {
        return Order::class;
    }

    public function list(array $data, $select)
    {
        $query = $this->model
            ->with('client')
            ->select($select);
        if (isset($data['search'])) {
            $query->whereHas('client', function ($q) use ($data) {
                    $q->where('name', 'like', "%{$data['search']}%");
            })
            ->orWhere('code', 'like', "%{$data['search']}%");
        }
        return $this->paginate($query, $this->handlePaginate($data));
    }
    public function listOrderByClient($id,$data, $select)
    {
        $query = $this->model->with('client')->select($select)->where('client_id', '=', $id);
        return $this->paginate($query, $this->handlePaginate($data));
    }

}
