<?php

namespace App\Helpers;

use App\Group;

class Dict
{
    public static function groups()
    {
        return Group::all();
    }
}
