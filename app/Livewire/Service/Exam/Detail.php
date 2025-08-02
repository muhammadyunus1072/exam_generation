<?php

namespace App\Livewire\Service\Exam;

use Exception;
use App\Helpers\Alert;
use App\Helpers\ExamHelper;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Repositories\Service\Exam\ExamRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;
use PhpParser\Node\Stmt\TryCatch;

class Detail extends Component
{

    public $objId;

    #[Validate('required', message: 'Jenjang Pendidikan Harus Diisi', onUpdate: false)]
    public $level;

    #[Validate('required', message: 'Kelas Harus Diisi', onUpdate: false)]
    public $grade;

    #[Validate('required', message: 'Mata Pelajaran Harus Diisi', onUpdate: false)]
    public $subject;
    public $question_amount = 1;
    public $minimal_score;

    public $curriculum = [];
    public $grades = [];
    public $subjects = [];
    public $exams_data = [];

    public function mount()
    {
        $this->curriculum = collect(ExamHelper::getCurriculum());
        if ($this->objId) {
            $exam = ExamRepository::find(ExamHelper::simple_decrypt($this->objId));
            $this->level = $exam->level;
            $this->updatedLevel($exam->level);
            $this->grade = $exam->grade;
            $this->updatedGrade($exam->grade);
            $this->subject = $exam->subject;
            $this->question_amount = ExamHelper::valueToImask($exam->question_amount);
            $this->minimal_score = ExamHelper::valueToImask($exam->minimal_score);
            $this->exams_data = json_decode($exam->exams_data, true);
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

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        if ($this->objId) {
            $this->redirectRoute('exam.edit', $this->objId);
        } else {
            $this->redirectRoute('exam.create');
        }
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('exam.index');
    }

    public function generate()
    {
        // $this->exams_data = [];
        try {
            $prompt = sprintf(
                "Buatkan sebanyak %s soal pilihan ganda untuk jenjang %s kelas %s pada mata pelajaran %s, berdasarkan Kurikulum Merdeka yang berlaku di Indonesia. " .
                    "Topik dan materi harus disesuaikan **khusus untuk tingkat kelas %s %s**, tidak boleh menggunakan materi dari kelas di bawah atau di atasnya. " .
                    "Gunakan struktur soal yang faktual, logis, relevan, dan mengacu pada capaian pembelajaran yang sesuai dengan kelas dan mata pelajaran tersebut. " .
                    "Gunakan bahasa Indonesia yang benar dan jelas, kecuali jika mata pelajaran adalah Bahasa Inggris, maka gunakan Bahasa Inggris. " .
                    "Hindari soal yang mengandung humor, fiksi, atau bersifat imajinatif. Fokus pada penguasaan konsep dan keterampilan sesuai standar kurikulum. " .
                    "Setiap soal harus memiliki 1 pertanyaan, 4 pilihan jawaban (a, b, c, d), dan hanya satu jawaban benar. " .
                    "Format keluaran harus dalam JSON valid tanpa tambahan teks lain, tanpa penjelasan, dan tanpa komentar. Contoh format JSON sebagai berikut:

[
    {
        'question': 'Apa fungsi utama paru-paru dalam sistem pernapasan manusia?',
        'choices': ['Menukar oksigen dan karbon dioksida', 'Mencerna makanan', 'Menyaring darah', 'Mengatur suhu tubuh'],
        'correct_answer': 'Menukar oksigen dan karbon dioksida'
    },
    ...
]

Berikan hanya isi array JSON sesuai format di atas.",
                ExamHelper::imaskToValue($this->question_amount),
                $this->level,
                $this->grade,
                $this->subject,
                $this->level,
                $this->grade
            );

            $data = ExamHelper::generateExam($prompt);
            if (!$data) {
                $this->generate();
            } else {
                $this->exams_data = $data;
            }
        } catch (Exception $e) {
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function store()
    {
        try {
            $this->validate();
            DB::beginTransaction();

            $validatedData = [
                'level' => $this->level,
                'grade' => $this->grade,
                'subject' => $this->subject,
                'question_amount' => ExamHelper::imaskToValue($this->question_amount),
                'minimal_score' => ExamHelper::imaskToValue($this->minimal_score),
                'exams_data' => json_encode($this->exams_data),
            ];

            if ($this->objId) {
                $objId = ExamHelper::simple_decrypt($this->objId);
                ExamRepository::update($objId, $validatedData);
            } else {
                $obj = ExamRepository::create($validatedData);
                $this->objId = ExamHelper::simple_encrypt($obj->id);
            }

            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Disimpan",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.service.exam.detail', [
            'levels' => $this->curriculum->pluck('level')->toArray()
        ]);
    }
}
