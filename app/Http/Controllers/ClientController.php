<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        session()->put('search', $data);
        $result = $this->clientService->listClient($data);
        return view('elements.client.index', compact('result'));
    }
}
