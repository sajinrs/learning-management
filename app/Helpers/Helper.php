<?php

namespace App\Helpers;
use App\Models\User;

class Helper
{
    public static function userDetails($userID)
    {
        $data = User::findOrFail($userID);
        return $data;
    }
}
