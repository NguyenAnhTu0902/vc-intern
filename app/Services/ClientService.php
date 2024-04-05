<?php

namespace App\Services;

use App\Constants\Constant;
use App\Repositories\ClientRepository;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function listClient($data, $select = '*')
    {
        $clients = $this->clientRepository->list($data, $select);
        return [
            'clients' => $clients,
            'itemStart' => $clients->firstItem(),
        ];

    }
}
