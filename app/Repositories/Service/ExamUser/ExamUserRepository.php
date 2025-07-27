<?php

namespace App\Repositories\Service\ExamUser;

use App\Models\ExamUser;
use App\Repositories\MasterDataRepository;

class ExamUserRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return ExamUser::class;
    }

    public static function datatable()
    {
        return ExamUser::query();
    }
}
