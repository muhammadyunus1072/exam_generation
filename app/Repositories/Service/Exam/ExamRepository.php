<?php

namespace App\Repositories\Service\Exam;

use App\Models\Exam;
use App\Repositories\MasterDataRepository;

class ExamRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return Exam::class;
    }

    public static function datatable()
    {
        return Exam::query();
    }
}
