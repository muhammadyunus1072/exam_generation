<?php

namespace App\Livewire\Service\PerformRecap;

use Exception;
use App\Helpers\Alert;
use App\Helpers\ExamHelper;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Repositories\Service\Exam\ExamRepository;
use App\Repositories\Service\ExamUser\ExamUserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;
use PhpParser\Node\Stmt\TryCatch;

class Detail extends Component
{

    public $objId;
    public $exam_id;
    public $perform_name;

    #[Validate('required', message: 'Jenjang Pendidikan Harus Diisi', onUpdate: false)]
    public $level;

    #[Validate('required', message: 'Kelas Harus Diisi', onUpdate: false)]
    public $grade;

    #[Validate('required', message: 'Mata Pelajaran Harus Diisi', onUpdate: false)]
    public $subject;
    public $question_amount = 1;
    public $minimal_score;
    public $score;

    public $exams_data = [];

    public function mount()
    {
        if ($this->objId) {
            $examUser = ExamUserRepository::findBy(whereClause: [['id', ExamHelper::simple_decrypt($this->objId)]]);
            $this->exam_id = ExamHelper::simple_encrypt($examUser->exam_id);
            $this->level = $examUser->exam->level;
            $this->grade = $examUser->exam->grade;
            $this->subject = $examUser->exam->subject;
            $this->question_amount = $examUser->exam->question_amount;
            $this->minimal_score = $examUser->exam->minimal_score;
            $this->score = $examUser->score;
            $this->perform_name = $examUser->user->name;
            $this->exams_data = json_decode($examUser->exams_data, true);
        }
    }

    public function render()
    {
        return view('livewire.service.perform-recap.detail');
    }
}
