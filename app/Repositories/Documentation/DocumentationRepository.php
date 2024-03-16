<?php

namespace App\Repositories\Documentation;

use App\Models\User;
use App\Helpers\MenuHelper;
use App\Models\Documentation;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MasterDataRepository;

class DocumentationRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return Documentation::class;
    }

    public static function getIdAndNames()
    {
        return Documentation::select('id', 'name')->orderBy('name')->get();
    }
    public static function first()
    {
        return Documentation::first();
    }


    public static function authenticatedUser(): User
    {
        return User::find(Auth::id());
    }
    public static function datatable()
    {
        return Documentation::query();
    }
}
