<?php

namespace App\Services;

use App\Repositories\OrderDetailRepository;

class OrderDetailService
{
    protected $orderDetailRepository;

    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function listDetailByOrder($id)
    {
        return $this->orderDetailRepository->listDetailByOrder($id);

    }
}
