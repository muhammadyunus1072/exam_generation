<?php

namespace App\Repositories\Account;

use App\Models\User;
use App\Repositories\MasterDataRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return User::class;
    }

    public static function authenticatedUser(): User
    {
        return self::find(Auth::id());
    }
}
