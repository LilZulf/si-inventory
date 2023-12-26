<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

class HashHelper
{
    public static function encryptPassword($password)
    {
        return Hash::make($password);
    }
}
