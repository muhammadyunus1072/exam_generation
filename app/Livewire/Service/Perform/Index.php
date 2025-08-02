<?php

namespace App\Livewire\Service\Perform;

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

class Index extends Component
{

    public $input_kode;
    public $kode;
    public $is_progress = true;

    #[Validate('required', message: 'Jenjang Pendidikan Harus Diisi', onUpdate: false)]
    public $level;

    #[Validate('required', message: 'Kelas Harus Diisi', onUpdate: false)]
    public $grade;

    #[Validate('required', message: 'Mata Pelajaran Harus Diisi', onUpdate: false)]
    public $subject;
    public $question_amount = 1;
    public $minimal_score;
    public $score;
    public $summary_message;

    public $curriculum = [];
    public $grades = [];
    public $subjects = [];
    public $exams_data = [];
    public $exams_answer = [];

    public function mount()
    {
        $this->curriculum = collect(ExamHelper::getCurriculum());
        if ($this->kode) {
            $this->getExam($this->kode);
        }
    }

    private function getExam($kode)
    {
        $done = ExamUserRepository::findBy(whereClause: [
            ['user_id', auth()->user()->id],
            ['exam_id', ExamHelper::simple_decrypt($this->kode)]
        ]);
        if ($done) {
            $this->is_progress = false;
            $this->score = $done->score;
            $this->minimal_score = $done->minimal_score;
            $this->summary_message = $done->summary_message;
        }
        $exam = ExamRepository::find(ExamHelper::simple_decrypt($kode));
        if ($exam) {
            $this->kode = ExamHelper::simple_encrypt($exam->id);
            $this->level = $exam->level;
            $this->updatedLevel($exam->level);
            $this->grade = $exam->grade;
            $this->updatedGrade($exam->grade);
            $this->subject = $exam->subject;
            $this->question_amount = $exam->question_amount;
            $this->minimal_score = $exam->minimal_score;
            $this->exams_data = json_decode($exam->exams_data, true);
        } else {
            return redirect()->route('perform.index');
        }
    }

    public function perform()
    {
        $exam = ExamRepository::find(ExamHelper::simple_decrypt($this->input_kode));
        if ($exam) {
            return redirect()->route('perform.index', ['kode' => $this->input_kode]);
        }
    }

    public function result()
    {
        $score_value = 100 / $this->question_amount;
        $score = 0;
        foreach ($this->exams_data as $key => $exam) {
            $this->exams_data[$key]['student_answer'] = $this->exams_answer[$key];
            ($this->exams_answer[$key] == $exam['correct_answer']) ? $score += $score_value : null;
        }
        $this->score = $score;
        $this->getSummaryMessage();
    }

    private function getSummaryMessage()
    {
        try {
            $examDataForPrompt = collect($this->exams_data)
                ->filter(function ($item) {
                    return ($item['correct_answer'] ?? null) !== ($item['student_answer'] ?? null);
                })
                ->map(function ($item) {
                    return [
                        'question' => $item['question'] ?? null,
                        'correct_answer' => $item['correct_answer'] ?? null,
                        'student_answer' => $item['student_answer'] ?? null,
                    ];
                })
                ->values()
                ->toArray();

            $prompt = sprintf(
                "Buatkan pesan evaluasi hasil ujian secara personal untuk siswa sekolah.

Informasi ujian:
- Jenjang: %s
- Kelas: %s
- Mata pelajaran: %s
- Nilai siswa: %s
- Nilai minimal lulus: %s

Jika siswa LULUS (nilai >= nilai minimal), berikan ucapan selamat dan ajakan untuk tetap belajar agar tidak lupa materi. Sebutkan kelebihan siswa jika bisa.

Jika siswa TIDAK LULUS (nilai < nilai minimal), berikan motivasi secara positif, sebutkan area yang perlu ditingkatkan berdasarkan kesalahan siswa, dan dorong semangat belajar. Gunakan bahasa ramah dan membangun kepercayaan diri.

Berikut adalah data jawaban salah dari soal ujian siswa dalam format JSON:

%s

Gunakan data di atas untuk menganalisis dan memberikan evaluasi yang sesuai.

Format keluaran:
- Format JSON valid. Gunakan hanya kutip ganda (\"). Tanpa komentar, tanpa teks tambahan. Jangan gunakan kutip melengkung.
- Jawaban hanya berupa JSON array (tanpa komentar, tanpa penjelasan, tanpa teks tambahan).
- Gunakan hanya tanda kutip ganda (\"), dan jangan pernah gunakan kutip tunggal (') atau kutip melengkung (‘ ’ “ ”) untuk format JSON.

Contoh format JSON yang harus diikuti:

[{\"summary_message\": \"...pesan evaluasi personal di sini...\"}]",
                $this->level,
                $this->grade,
                $this->subject,
                $this->score,
                $this->minimal_score,
                json_encode($examDataForPrompt, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );

            $data = ExamHelper::generateExam($prompt);

            if (!$data) {
                $this->getSummaryMessage();
            } else {
                $this->summary_message = $data[0]['summary_message'];
            }
            DB::beginTransaction();

            $validatedData = [
                'exam_id' => ExamHelper::simple_decrypt($this->kode),
                'user_id' => auth()->user()->id,
                'score' => $this->score,
                'minimal_score' => $this->minimal_score,
                'summary_message' => $this->summary_message,
                'exams_data' => json_encode($this->exams_data),
            ];

            $obj = ExamUserRepository::create($validatedData);

            DB::commit();
            return redirect()->route('perform.index', ['kode' => $this->kode]);
        } catch (Exception $e) {
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function updatedLevel($value)
    {
        $selected = $this->curriculum->firstWhere('level', $value);
        $this->grades = collect($selected['grades'] ?? [])->pluck('grade_name')->toArray();

        $this->grade = null;
        $this->subject = null;
        $this->subjects = [];
        $this->exams_data = [];
    }

    public function updatedGrade($value)
    {
        $levelData = $this->curriculum->firstWhere('level', $this->level);

        $gradeData = collect($levelData['grades'] ?? [])
            ->firstWhere('grade_name', $value);

        $this->subjects = collect($gradeData['subjects'] ?? [])
            ->pluck('subject_name')
            ->toArray();

        $this->subject = null;
        $this->exams_data = [];
    }

    public function render()
    {
        return view('livewire.service.perform.index', [
            'levels' => $this->curriculum->pluck('level')->toArray()
        ]);
    }
}
