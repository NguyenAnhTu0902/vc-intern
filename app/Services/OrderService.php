<?php

namespace App\Services;

use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    protected $orderRepository;
    protected $orderDetailRepository;

    public function __construct(OrderRepository $orderRepository, OrderDetailRepository $orderDetailRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function listOrder($data, $select = '*')
    {
        $orders = $this->orderRepository->list($data, $select);
        return [
            'orders' => $orders,
            'itemStart' => $orders->firstItem(),
        ];

    }
    public function listOrderByClient($id, $data, $select = '*')
    {
        $listOrder =   $this->orderRepository->listOrderByClient($id, $data, $select);
        return [
            'listOrder' => $listOrder,
            'itemStart' => $listOrder->firstItem(),
        ];
    }

    public function updatestatus($request, $id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->findOrFail($id);
            if($order) {
                $order->update($request->only('status'));
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }
    }

    public function deleteOrder($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->findOrFail($id);
            if($order){
                $this->orderRepository->deleteById($id);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return false;
        }

    }
}
