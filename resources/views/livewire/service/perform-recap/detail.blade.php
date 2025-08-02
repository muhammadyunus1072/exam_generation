<form wire:submit="store">
    
    <div class="row mb-3">
        <div class="col-auto">
            <a href="{{route('perform_recap.index', $exam_id)}}" class="btn btn-info mt-3 px-5">
                Kembali
            </a>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 mb-1">
            <label for="level">Nama Peserta</label>
            <p class="pt-3">{{$perform_name}} - {!! ($score >= $minimal_score) ? "<span class='badge badge-success'>Lulus</span>" : "<span class='badge badge-danger'>Tidak Lulus</span>" !!}</p>
        </div>
        <div class="col-md-6 mb-1">
            <label for="level">Jenjang Pendidikan</label>
            <p class="form-control">{{ $level }}</p>
        </div>
        <div class="col-md-6 mb-1">
            <label for="level">Jumlah Soal</label>
            <p class="form-control">{{ $question_amount }}</p>
        </div>
        <div class="col-md-6 mb-1">
            <label for="level">Kelas</label>
            <p class="form-control">{{ $grade }}</p>
        </div>
        <div class="col-md-6 mb-1">
            <label for="level">Nilai Minimal Lulus</label>
            <p class="form-control">{{ $minimal_score }}</p>
        </div>
        <div class="col-md-6 mb-1">
            <label for="level">Mata Pelajaran</label>
            <p class="form-control">{{ $subject }}</p>
        </div>
        <div class="col-md-6 mb-1">
            <label for="level">Nilai Akhir</label>
            <p class="form-control">@currency($score)</p>
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

    <hr>
    <div class="row">
        <div class="col-md-6 mb-1">
            <label for="level">Pesan Kesimpulan</label>
            <p class="form-control">{{$summary_message}}</p>
        </div>
    </div>

</form>

@include('js.imask')
