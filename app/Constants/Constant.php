<?php

namespace App\Constants;

class Constant
{
    const KEY_LIMIT = 'limit';
    const INPUT_PAGE = 'page';
    const INPUT_PAGE_SIZE = 'page_size';

    const PATH_PRODUCT = 'products'.DIRECTORY_SEPARATOR. 'images' . DIRECTORY_SEPARATOR;

    public const MAX_FILE_SIZE = 2;
    public const KBS_IN_ONE_MB = 1024;

    public const STATUS_WAITING = 1;
    public const STATUS_DOING = 2;
    public const STATUS_SHIPPING = 3;
    public const STATUS_DONE = 4;
    public const STATUS_CANCEL = 5;
    public const STATUS_TEXT = [
        self::STATUS_WAITING => 'Đang chờ duyệt',
        self::STATUS_DOING => 'Đang chuẩn bị',
        self::STATUS_SHIPPING => 'Đang vận chuyển',
        self::STATUS_DONE => 'Hoàn tất',
        self::STATUS_CANCEL => 'Hủy'
    ];

    const SUP_ADMIN = 'Super-admin';
    const ADMIN = 'Admin';

}
