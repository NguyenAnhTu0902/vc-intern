<?php

namespace App\Models;

use App\Constants\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'status'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function getStatusAttribute($value)
    {
        $openBTag = '<b>';
        $closeTag = '</b></span>';
        return match ($value) {
            Constant::STATUS_WAITING =>
                "<span class='text-warning-custom'>" . $openBTag
                . Constant::STATUS_TEXT[Constant::STATUS_WAITING] .
                $closeTag,
            Constant::STATUS_DOING =>
                "<span class='text-primary'>" . $openBTag
                . Constant::STATUS_TEXT[Constant::STATUS_DOING] .
                $closeTag,
            Constant::STATUS_SHIPPING =>
                "<span class='text-info'>" . $openBTag
                . Constant::STATUS_TEXT[Constant::STATUS_SHIPPING] .
                $closeTag,
            Constant::STATUS_DONE =>
                "<span class='text-success'>" . $openBTag
                . Constant::STATUS_TEXT[Constant::STATUS_DONE] .
                $closeTag,
            Constant::STATUS_CANCEL =>
                "<span class='text-danger'>" . $openBTag
                . Constant::STATUS_TEXT[Constant::STATUS_CANCEL] .
                $closeTag,
            default => null
        };
    }

    public const STATUS_WAITING = 1;
    public const STATUS_DOING = 2;
    public const STATUS_SHIPPING = 3;
    public const STATUS_DONE = 4;
    public const STATUS_CANCEL = 5;
    public static array $type = array(
        self::STATUS_WAITING => 'Đang chờ duyệt',
        self::STATUS_DOING => 'Đang chuẩn bị',
        self::STATUS_SHIPPING => 'Đang vận chuyển',
        self::STATUS_DONE => 'Hoàn tất',
        self::STATUS_CANCEL => 'Hủy'
    );
}
