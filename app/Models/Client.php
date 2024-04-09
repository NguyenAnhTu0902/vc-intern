<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];

    public function userOrders()
    {
        return $this->hasOneThrough(
            OrderDetail::class,
            Order::class
        );
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
