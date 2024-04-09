<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OrderDetailService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    protected $orderDetailService;

    public function __construct(OrderService $orderService, OrderDetailService $orderDetailService)
    {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $result = $this->orderService->listOrder($data);

        return view('elements.order.index', compact('result'));
    }

    public function detail($id)
    {
        $order = $this->orderDetailService->listDetailByOrder($id);
        return view('elements.order.detail', compact('order'));
    }

    public function update(Request $request, $id)
    {
        return $this->orderService->updateStatus($request, $id) ?
                redirect()->route('order.index')->with('alert', 'Cập nhật thành công!') :
                redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }

    public function delete($id)
    {
        return $this->orderService->deleteOrder($id) ?
            redirect()->route('order.index')->with('alert', 'Xóa thành công!') :
            redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }
}
