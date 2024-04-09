<?php

namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository extends EloquentRepository
{
    protected $model;

    public function model()
    {
        return OrderDetail::class;
    }

    public function listDetailByOrder($id)
    {
        return $this->model->with('product')->where('order_id', '=', $id)->get();
    }
}
