<form wire:submit="store">
    <div class="row">
        <div class="mb-3">
            <label for="level">Jenjang Pendidikan</label>
            <select wire:model.live="level" class="form-control" id="level">
                <option value="">-- Pilih Jenjang --</option>
                @foreach($levels as $levelOption)
                    <option value="{{ $levelOption }}">{{ $levelOption }}</option>
                @endforeach
            </select>
        </div>

        @if (!empty($grades))
        <div class="mb-3">
            <label for="grade">Kelas</label>
            <select wire:model.live="grade" class="form-control" id="grade">
                <option value="">-- Pilih Kelas --</option>
                @foreach($grades as $gradeOption)
                    <option value="{{ $gradeOption }}">{{ $gradeOption }}</option>
                @endforeach
            </select>
        </div>
        @endif

        @if (!empty($subjects))
        <div class="mb-3">
            <label for="subject">Mata Pelajaran</label>
            <select wire:model.live="subject" class="form-control" id="subject">
                <option value="">-- Pilih Mapel --</option>
                @foreach($subjects as $subjectOption)
                    <option value="{{ $subjectOption }}">{{ $subjectOption }}</option>
                @endforeach
            </select>
        </div>
        @endif

        @if (!empty($subject))
        <div class="mb-3">
            <label for="minimal_score">Jumlah Soal</label>
            <input placeholder="Jumlah Soal" type="text" min="1" class="form-control currency @error('question_amount') is-invalid @enderror" wire:model="question_amount" />
    
            @error('question_amount')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @endif
        @if (!empty($subject))
        <div class="mb-3">
            <label for="minimal_score">Nilai Minimal Lulus</label>
            <input placeholder="Nilai Minimal Lulus" type="text" min="0" max="100" class="form-control currency @error('minimal_score') is-invalid @enderror" wire:model="minimal_score" />
    
            @error('minimal_score')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @endif

        @if (!empty($subject))

        <div class="col-md-3 mx-auto">
            <button type="button" class="btn text-white w-100" style="background-color: #5d2fc2; " wire:click="generate"> 
                <span wire:loading.class="d-none" wire:target="generate" class="text-white indicator-label"> <i class='fas fa-wand-magic-sparkles text-white'></i> Generate Soal Ujian</span>
                <span wire:loading class="text-white indicator-progress" wire:target="generate"> <i wire:loading class="text-white indicator-progress animate-wand fas fa-wand-magic-sparkles text-white"></i> &nbsp; Sedang Memproses
                </span>
            </button>
        </div>
        @endif
    </div>
    
    @foreach ($exams_data as $number => $exams)
        
        <p><span class="fw-bold">{{$number+1}}. </span> {{$exams['question']}}</p>
        <ul class="list-group list-group-flush">
            @foreach ($exams['choices'] as $index => $choice)
                <li class="list-group-item">{{ chr(65 + $index) }}. {{$choice}}</li>
            @endforeach
        </ul>
        <p>Jawaban => {{$exams['correct_answer']}}</p>
    @endforeach

    @if ($exams_data)
    <div class="row">
        <div class="col-auto">
            <button type="submit" class="btn btn-success mt-3">
                <i class='ki-duotone ki-check fs-1'></i>
                Simpan
            </button>
        </div>
        <div class="col-auto">
            <div x-data="{ copied: false }">
                <div class="flex items-center">
                    <button type="button"
                        @click="
                            navigator.clipboard.writeText('{{$objId}}')
                            copied = true;
                            setTimeout(() => copied = false, 1500);
                        "
                        class="btn btn-primary mt-3"
                    >
                        <i class="fas fa-copy"></i> Copy Kode
                    </button>

                    <span x-show="copied" x-transition class="text-success text-sm">
                        Copied!
                    </span>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <a href="{{route('perform.index', ['kode' => $objId])}}" target="_BLANK" class="btn btn-info mt-3">
                Lihat Ujian
            </a>
        </div>
    </div>

    @endif
</form>

@push('css')
    <style>
        @keyframes pulse-wand {
            0%   { transform: scale(1);   opacity: 1; }
            50%  { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1);   opacity: 1; }
        }

        .animate-wand {
            animation: pulse-wand 1s infinite ease-in-out;
        }
    </style>
@endpush
@include('js.imask')
