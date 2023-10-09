<?php

namespace App\Enums;

enum StatusesEnum
{
    public const PENDING = 2;
    public const ACCEPTED = 1;
    public const REJECTED = 0;

    public static function all()
    {
        return [
            self::PENDING => 'Pending',
            self::ACCEPTED => 'Accepted',
            self::REJECTED => 'Rejected'
        ];
    }
}
