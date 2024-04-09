<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    protected $orderService;

    public function __construct(ClientService $clientService, OrderService $orderService)
    {
        $this->clientService = $clientService;
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $result = $this->clientService->listClient($data);
        return view('elements.client.index', compact('result'));
    }

    public function detail($id, Request $request)
    {
        $data = $request->all();
        $result = $this->orderService->listOrderByClient($id, $data);
        return view('elements.client.detail', compact('result'));
    }

    public function delete($id)
    {
        return $this->clientService->deleteClient($id) ?
            redirect()->route('client.index')->with('alert', 'Xóa thành công!') :
            redirect()->refresh()->with('alert', 'Xảy ra lỗi!');
    }
}
