<?php

namespace App\Repositories;

use App\Constants\CommonConstants;
use App\Models\Client;

class ClientRepository extends EloquentRepository
{

    protected $model;


    public function model()
    {
        return Client::class;
    }

    public function list(array $data, $select)
    {
        $query = $this->model
                ->select($select);
        if (isset($data['search'])) {
            $query->where('name', 'like', '%' . $data['search'] . '%');
        }
        return $this->paginate($query, $this->handlePaginate($data));
    }
}
