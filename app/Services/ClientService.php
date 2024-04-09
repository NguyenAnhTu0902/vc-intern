<?php

namespace App\Services;

use App\Constants\Constant;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function deleteClient($id)
    {
        DB::beginTransaction();
        try {
            $client = $this->clientRepository->findOrFail($id);
            if($client){
                $this->clientRepository->deleteById($id);
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
