<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Repositories\ClientRepository;
use App\Repositories\OrderRepository;
use App\Services\ClientService;
use App\Services\OrderService;

class HomePageController extends Controller
{
    protected $orderRepository;

    protected $clientRepository;

    public function __construct(OrderRepository $orderRepository, ClientRepository $clientRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->clientRepository = $clientRepository;
    }
    public function index()
    {
        $totalClient = Client::count();
        $totalOrder = $this->orderRepository->getTotalOrder();
        $totalRevenue = $this->orderRepository->getTotalRevenue();
        $listClient = $this->clientRepository->getClient();
        $listOrder = $this->orderRepository->getOrder();
        return view('elements.dashboard.index', compact('totalClient', 'totalOrder', 'totalRevenue', 'listClient', 'listOrder'));
    }
}
