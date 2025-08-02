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

    public static function datatable($id)
    {
        return ExamUser::select(
            'exam_users.id as id',
            'exam_users.score as score',
            'exam_users.minimal_score as minimal_score',
            'exam_users.summary_message as summary_message',
            'users.name as perform_name',
        )
            ->join('users', 'exam_users.user_id', '=', 'users.id')
            ->where('exam_id', '=', $id);
    }
}
