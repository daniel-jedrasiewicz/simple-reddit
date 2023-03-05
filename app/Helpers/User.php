<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class User
{
    public static function checkAuthorized(int $userId)
    {
        if($userId != Auth::id()) return abort('403');
    }
}
