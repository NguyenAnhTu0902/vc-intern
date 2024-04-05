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
}
