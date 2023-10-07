<?php

namespace App\Enums;

use App\Http\Controllers\Admin\ApplicationsController;

class ResourcesEnum
{
    public const NAMES = [
        'applications'
    ];

    public const CLASSES = [
        ApplicationsController::class
    ];

    public static function all()
    {
        return array_combine(self::NAMES, self::CLASSES);
    }
}
