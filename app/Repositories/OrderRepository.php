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
}
