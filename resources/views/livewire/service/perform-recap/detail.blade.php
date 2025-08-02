<form wire:submit="store">
    <div class="row">
        <div class="mb-3">
            <label for="level">Jenjang Pendidikan</label>
            <p class="form-control">{{ $level }}</p>
        </div>
        <div class="mb-3">
            <label for="level">Kelas</label>
            <p class="form-control">{{ $grade }}</p>
        </div>
        <div class="mb-3">
            <label for="level">Mata Pelajaran</label>
            <p class="form-control">{{ $subject }}</p>
        </div>
        <div class="mb-3">
            <label for="level">Jumlah Soal</label>
            <p class="form-control">{{ $question_amount }}</p>
        </div>
        <div class="mb-3">
            <label for="level">Nilai Minimal Lulus</label>
            <p class="form-control">{{ $minimal_score }}</p>
        </div>
        <div class="mb-3">
            <label for="level">Nilai Akhir</label>
            <p class="form-control">@currency($score)</p>
        </div>
        <div class="mb-3">
            <label for="level">Status</label>
            <p>{!! ($score >= $minimal_score) ? "<span class='badge badge-success'>Lulus</span>" : "<span class='badge badge-danger'>Tidak Lulus</span>" !!}</p>
        </div>
    </div>
    
    @foreach ($exams_data as $number => $exams)
        
        <p><span class="fw-bold">{{$number+1}}. </span> {{$exams['question']}}</p>
        <ul class="list-group list-group-flush">
            @foreach ($exams['choices'] as $index => $choice)
                <li class="list-group-item {{ ($choice == $exams['student_answer'] ) ? (($exams['student_answer'] == $exams['correct_answer']) ? 'bg-success' : 'bg-warning') : ''  }}">{{ chr(65 + $index) }}. {{$choice}}</li>
            @endforeach
        </ul>
        @if ($exams['correct_answer'] !== $exams['student_answer'])
            <p>Jawaban => {{$exams['correct_answer']}}</p>
        @endif
    @endforeach

    <div class="row">
        <div class="col-auto">
            <a href="{{route('perform_recap.index', $exam_id)}}" class="btn btn-success mt-3">
                Kembali
            </a>
        </div>
    </div>
</form>

@include('js.imask')
