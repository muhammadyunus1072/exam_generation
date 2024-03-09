<?php

namespace App\Repositories\Account;

use App\Repositories\MasterDataRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return Role::class;
    }
}
