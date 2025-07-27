<div class="">
  @if (!$kode)
      <div class="mb-3">
          <label for="minimal_score">Kode</label>
          <input placeholder="Kode" type="text" class="form-control @error('input_kode') is-invalid @enderror" wire:model="input_kode" />
  
          @error('input_kode')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
      <div class="row">
        <div class="col-auto">
            <button type="button" class="btn btn-success mt-3" wire:click="perform">
                <i class='ki-duotone ki-check fs-1'></i>
                Masuk
            </button>
        </div>
      </div>
  @else
      
  <section class="row mt-0">
    <div class="white-text">
      <h4 class="lh-sm my-0 py-1"><strong>Soal Ujian</strong> </h4>
      <div class="d-flex justify-content-between">
        <div class="col-md-auto">
          <table class="table m-0 p-0 table-borderless text-black mb-0">
            <tbody>
              <tr>
                <td><strong class="my-o py-0">Jenjang Sekolah</strong></td>
                <td>:<strong class="my-o py-0"> {{ $level }}</strong></td>
              </tr>
              <tr>
                <td><strong class="my-o py-0">Kelas</strong></td>
                <td>:<strong class="my-o py-0"> {{ $grade }}</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-auto">
          <table class="table m-0 p-0 table-borderless text-black mb-0">
            <tbody>
              <tr>
                <td><strong class="my-o py-0">Mata Pelajaran</strong></td>
                <td>:<strong class="my-o py-0"> {{ $subject }}</strong></td>
              </tr>
              <tr>
                <td><strong class="my-o py-0">Jumlah Soal</strong></td>
                <td>:<strong class="my-o py-0"> {{ $question_amount }}</strong></td>
              </tr>
              <tr>
                <td><strong class="my-o py-0">Nilai Minimal Lulus</strong></td>
                <td>:<strong class="my-o py-0"> {{ $minimal_score }}</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  
    </div>
  </section>
  <section>
    <div id="exam-section">
      <div class="carousel--wrapper carousel--wrapper--sec">
        <div class="carousel" >
          <div class="progress-bar" >
            <div class="progress-bar-insider" data-progress="🏁🏁" ></div>
          </div>
          <div class="carousel__content" style=" transform: translate(0%, 0px);" >
            <div class="carousel--item" style="width: 5.55556%;">
              <p class="carousel--title carousel--title--sub"> Sebelum memulai ujian, pastikan Anda sudah membaca petunjuk dengan seksama.  
        Luangkan waktu sejenak untuk berdoa agar ujian berjalan lancar dan hasilnya maksimal.</p>
              <span class="carousel--radios"><button class="btn btn-primary nav--buttons--right mt">Mulai Ujian</button>
                </span>
            </div>
            @foreach ($exams_data as $number => $exam)
              <div class="carousel--item" style="width: 5.55556%;">
                <p class="fs-5">{{$number + 1}}. {{$exam['question']}}</p>
                <div class="carousel--radios">
                  @foreach ($exam['choices'] as $index => $choice)  
                    <label class="fs-5"><input type="radio" wire:model="exams_answer.{{$number}}" name="q1" value="{{$choice}}"> {{ chr(65 + $index) }}. {{$choice}}</label> 
                  @endforeach
                </div>
              </div>
            @endforeach
            <div class="carousel--item" style="width: 5.55556%;" >
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
  
    <div class="row d-block d-flex justify-content-center" id="loading-section">
      <div class="btn text-white col-auto" style="background-color: #5d2fc2; ">
        
          <i class="indicator-progress animate-wand fas fa-wand-magic-sparkles"></i>  
          Sedang Memproses
        
      </div>
    </div>
    <div class="row d-none" id="summary-section">
      <h3 class="fw-bold">Nilai : {{$score}}</h3>
      <h3 class="fw-bold">Status : {!!$score >= $minimal_score ? '<span class="text-success">Lulus</span>' : '<span class="text-danger">Tidak Lulus</span>' !!}</h3>
      <h3 class="fw-bold">Pesan Kesimpulan : {{$summary_message}}</h3>
    </div>
  </section>
  @endif
</div>

@push('css')
{{-- <link rel="stylesheet" href="https://tenable.com/css/style.css"> --}}
<link rel="stylesheet" href="https://tenable.com/lp/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
        
        .carousel{
            overflow-x: hidden !important;
        }
        footer {
        color: #555559;
        }

        strong {
        font-size: 1.5em;
        }

        .title {
        background: url(/sites/all/themes/tenablefourteen/img/16/bg-generic.png), linear-gradient(180deg, #430098, #0071CE), #00A5B5;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        text-align: center;
        }

        .title h1 {

        padding: .5em 0;
        font-size: 4em;
        font-weight: 200;
        }

        title p {
        font-size: 1.125em;
        }

        .flex-grid {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        flex-direction: row;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        margin: 0 auto;
        }

        .flex-one,
        .flex-two {
        width: 100%;
        background-color: #fff;
        color: #fff;
        margin-bottom: 2em;
        padding: 1em;
        }
        .flex-one p,
        .flex-two p {
        font-size: 1.125em;
        text-shadow: 2px 2px 5px #263746;
        }
        body {
      --fc-event-border-color: white;
      --fc-event-bg-color: white;
      --fc-event-text-color: white;
    }
            .flex-one.flex-fewer,
            .flex-two.flex-fewer {
            background: url("/sites/all/themes/tenablefourteen/img/backgrounds/bg-dots.png") center center no-repeat, linear-gradient(0deg, #00236d, #003bba);
            background-color: #0033a0;
            }
            .flex-one.flex-same,
            .flex-two.flex-same {
            background: url("/sites/all/themes/tenablefourteen/img/backgrounds/bg-dots.png") center center no-repeat, linear-gradient(0deg, #00559b, #028dff);
            background-color: #0071ce;
            margin-top: -1em;
            margin-bottom: 1em;
            }
            .flex-one.flex-more,
            .flex-two.flex-more {
            background: url("/sites/all/themes/tenablefourteen/img/backgrounds/bg-dots.png") center center no-repeat, linear-gradient(0deg, #21004c, #4e00b2);
            background-color: #430098;
            }

            @media (min-width: 38em) {
            .flex-one,
            .flex-two {
                width: 47%;
            }
            }
            @media (min-width: 64em) {
            .flex-one {
                width: 23%;
            }

            .flex-two {
                width: 32%;
            }
            }

            .gray {
            background: #f5f5f5;
            }

            .lightgray {
            background: #fff;
            }

            /* Bobby's CSS */
            body,
            html {
            overflow-x: hidden;
            }

            .carousel--wrapper {
            /* max-width: 940px; */
            width: 100%;
            position: relative;
            /* margin: 0 auto; */
            }
            .carousel .carousel__content .carousel--item {
        background-color: white !important;
    }
    .carousel .carousel__content .carousel--item .carousel--title {
        /* transform: translateY(-50px); */
        padding: 0;
        margin-bottom: 0;
        font-size: 3rem;
        width: 100%;
        text-align: center;
        color: black !important;
        opacity: 0.6;
    }
    .carousel .carousel__content .carousel--item .carousel--radios {
        font-size: 2em;
        color: black !important;
        opacity: 1;

        display: flex;
        flex-direction: column;     /* stack vertically */
        align-items: flex-start;    /* align radio group to the left */
        justify-content: flex-start;
        text-align: left;           /* align label text left */
        gap: 0.5rem;
        width: 100%;                /* ensure full width so left alignment takes effect */
    }
    .carousel .carousel__content .carousel--item {
        text-align: left;
        align-items: flex-start; /* if flex */
        justify-content: flex-start; /* if flex */
    }
        .carousel--wrapper--sec {
        overflow: visible;
        }

        /*
        .carousel--wrapper--sec:after, .carousel--wrapper--sec:before {
        content: "";
        position: absolute;
        width: 800px;
        height: 100%;
        top: 0;
        left: 100%;
        background: rgba(255, 255, 255, 0.5);
        z-index: 2;
        }

        .carousel--wrapper--sec:before {
        left: -800px;
        }
        */

        .carousel {
        width: 100%;
        position: relative;
        }
        .carousel .progress-bar {
        position: relative;
        background-color: #fff;
        height: 2em;
        }
        .carousel .progress-bar .progress-bar-insider {
        position: relative;
        background-color: #00a5b5;
        box-shadow: inset 0 -1px 1px rgba(255, 255, 255, 0.3);
        width: 4%;
        height: 2em;
        transition: 0.2s width;
        }
        .carousel .progress-bar .progress-bar-insider:after {
        content: attr(data-progress);
        color: white;
        position: absolute;
        right: 0.5em;
        top: 50%;
        transform: translateY(-50%);
        }
        .carousel .carousel__content {
        width: auto;
        position: relative;
        overflow: hidden;
        -webkit-backface-visibility: hidden;
        -webkit-transition: translate3d(0, 0, 0);
        }
        .carousel .carousel__content .carousel--item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-direction: normal;
            -ms-flex-direction: column;
                flex-direction: column;
        float: left;
        height: 25rem;
        background-color: #425363;
        }
        .carousel .carousel__content .carousel--item.teal {
        background-color: #00A5B5;
        }
        .carousel .carousel__content .carousel--item.accent-teal {
        background-color: #00839B;
        }
        .carousel .carousel__content .carousel--item {
        background-color: #33006F;
        }
        .carousel .carousel__content .carousel--item.accent {
        background-color: #33006F;
        }
        .carousel .carousel__content .carousel--item.blue {
        background-color: #002F87;
        }
        .carousel .carousel__content .carousel--item {
        background-color: #0071CE;
        }
        .carousel .carousel__content .carousel--item .carousel--title {
        /* transform: translateY(-50px); */
        padding: 0;
        margin-bottom: 0;
        font-size: 3rem;
        width: 100%;
        text-align: center;
        color: #fff;
        opacity: 0.6;
        }
        .carousel .carousel__content .carousel--item .carousel--title--sub {
        font-size: 1.2em;
        /*padding: 0 16%;*/
        max-width: 40em;
        opacity: 1;
        }
        .carousel .carousel__content .carousel--item .carousel--radios {
        font-size: 2em;
        color: #fff;
        opacity: 1;
        text-align: center;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        }

        .radio-item {
        display: flex;
        justify-content: start;
        -webkit-box-direction: normal;
            -ms-flex-direction: column;
                flex-direction: column;
        /* text-align: center; */
        margin: 0 2em;
        }

        .carousel .carousel__content .carousel--item .carousel--btn {

        font-size: 2em;
        }
        .carousel .carousel__nav {
        position: absolute;
        width: 100%;
        top: 50%;
        margin-top: -17px;
        left: 0;
        z-index: 1;
        }
        .carousel .carousel__nav .nav--buttons {
        position: absolute;
        top: 0;
        color: rgba(255, 255, 255, 0.75);
        background: rgba(255, 255, 255, 0.5);
        padding: 12px 12px;
        font-weight: bold;
        text-decoration: none;
        font-size: 1.5rem;
        transition: padding .25s ease;
        }
        .carousel .carousel__nav .nav--buttons:hover {
        padding: 15px 15px;
        }
        .carousel .carousel__nav .nav--buttons--left {
        border-radius: 0px 3px 3px 0px;
        }
        .carousel .carousel__nav .nav--buttons--right {
        right: 0;
        border-radius: 3px 0px 0px 3px;
        }

        label {
        padding: .25em 0 0;
        cursor: pointer;
        }

        input[type="radio"] {
        appearance: none;
        -moz-appearance: none;
        margin: 0 1em;
        width: 0.6em;
        height: 0.6em;
        background: #eeeeee;
        box-shadow: inset 0 0 0 .4em #fff, 0 0 0 .2em;
        border-radius: 50%;
        transition: .2s;
        cursor: pointer;
        color: #ddd;
        text-align: center;
        -ms-flex-item-align: center;
        align-self: center;
        }
        input[type="radio"]:hover, input[type="radio"]:checked {
        background: #000;
        box-shadow: inset 0 0 0 .5em #fff, 0 0 0 .25em #00A5B5;
        }
        input[type="radio"]:checked {
        background: #000;
        box-shadow: inset 0 0 0 .4em #fff, 0 0 0 .2em #00A5B5;
        }
        input[type="radio"]:focus {
        outline: 0;
        }

        .middle-flex {
        margin-top: -1em;
        margin-bottom: 1em;
        }

        @media (max-width: 40em) {
        .carousel--title {
            top: 20% !important;
            font-size: 2em !important;
        }

        .carousel--title--sub {
            margin-top: 0.5em !important;
            font-size: 1em !important;
        }

        .carousel--radios {
            top: 45% !important;
        }

        .carousel--btn {
            font-size: 1.25em !important;
        }

        .carousel--title {
            font-size: 1.5em !important;
        }

        .carousel--title--sub {
            font-size: 0.9em !important;
        }

        .carousel--radios {
            top: 40% !important;
            font-size: 1.5em !important;
        }

        .full-when-mobile {
            width: 100%;
        }
        }

        @media (min-width: 30em) and (max-width: 60em) {
        .carousel--radios {
            width: 80% !important;
        }
        .progress-bar-insider {
            font-size: 0.8em;
            padding: 1.25em !important;
        }
        }

        @media (max-width: 30em) {
        .carousel--radios {
            margin-top: 2em;
            width: 85% !important;
            font-size: 1.2em !important;
        }
        .progress-bar-insider {
            font-size: 0.5em;
            padding: 2em !important;
        }
        }

        .score-slider-track {
        margin-bottom: 4em;
        position: relative;
        border-radius: 0.125em;
        background: linear-gradient(90deg, #ccc, #888);
        box-shadow: 0 0.1em 0.1em rgba(0, 0, 0, 0.375);
        height: 3em;
        width: 100%;
        }
        .score-slider-track .score-slider {
        position: relative;
        height: 5em;
        width: 10%;
        background-color: #0071CE;
        color: #fff;
        box-shadow: 0 0.5em 1em rgba(0, 0, 0, 0.25);
        transform: translateX(-5%);
        top: -1em;
        left: 0%;
        transition: 0.8s;
        border-radius: 0.125em;
        line-height: 5em;
        font-weight: bold;
        z-index: 3;
        }
        .score-slider-track .score-slider-less {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;
        border-top-left-radius: 0.25em;
        border-bottom-left-radius: 0.25em;
        background-color: #0033A0;
        color: #fff;
        line-height: 3em;
        height: 3em;
        width: 0%;
        transition: 0.8s;
        }
        .score-slider-track .score-slider-more {
        position: absolute;
        color: white;
        line-height: 3em;
        top: 0;
        right: 0;
        z-index: 0;
        border-top-right-radius: 0.25em;
        border-bottom-right-radius: 0.25em;
        background-color: #430098;
        color: #fff;
        height: 3em;
        width: 98%;
        transition: 0.8s;
        }


</style>

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

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.9/jquery.transit.min.js"></script>
    <script>
      var contentTran = 0;
        (function () {
    var carouselTransition, carouselContent, carouselIndex, carouselLength, firstClone, firstItem, isAnimating, itemWidth, lastClone, lastItem;
    carouselTransition = 250;
    carouselContent = $('.carousel__content');
    carouselIndex = 0;
    carouselMax = 0;
    carouselLength = carouselContent.children().length;
    isAnimating = false;
    itemWidth = 100 / carouselLength;
    firstItem = $(carouselContent.children()[0]);
    lastItem = $(carouselContent.children()[carouselLength - 1]);
    firstClone = null;
    lastClone = null;
    carouselContent.css('width', carouselLength * 100 + '%');
    contentTran = carouselIndex * -itemWidth + '%';
    console.log(contentTran);
    carouselContent.transition({ x: contentTran}, 0);
    $.each(carouselContent.children(), function () {
        return $(this).css('width', itemWidth + '%');
    });
    $('.nav--buttons--left').on('click', function (event) {
        event.preventDefault();
        if (isAnimating || carouselIndex === 0) {
            return;
        }
        isAnimating = true;
        carouselIndex--;
        update_progress_bar(carouselIndex);
        $(".nav--buttons--right").css("display", "block");
        if (carouselIndex === 0 || carouselIndex === 1) {
          $(".nav--buttons--left").css("display", "none");
        }
        contentTran = carouselIndex * -itemWidth + '%';
    console.log(contentTran);
        return carouselContent.transition({ x: contentTran }, carouselTransition, 'ease', function () {
            return isAnimating = false;
        });
    });
    $('.nav--buttons--right').on('click', function (event) {
        event.preventDefault();
        if (isAnimating || carouselIndex === carouselLength - 1) {
            return;
        }
        isAnimating = true;
        carouselIndex++;
        update_progress_bar(carouselIndex);
        if ( carouselIndex > carouselMax ) {
          carouselMax = carouselIndex;
        }
        $(".nav--buttons--left").css("display", "block");
        if (carouselIndex === carouselLength - 1 || carouselIndex === carouselMax) {
          $(".nav--buttons--right").css("display", "none");
        }
        if (carouselIndex === 1) {
          $(".nav--buttons--left").css("display", "none");
        }
        contentTran = carouselIndex * -itemWidth + '%';
    console.log(contentTran);
        return carouselContent.transition({ x: contentTran }, carouselTransition, 'ease', function () {
            return isAnimating = false;
        });
    });
}.call(this));

function calc_results() {
  var count;
  $(".questions").each(function(){
    if(this.is(":checked")) {
      count++;
    }
  });
}


function sumArray(from, to, size) {
  var sum = parseFloat("0.00");
  for ( var i = from; i <= to; i++ ) {
    sum += parseFloat(results[i][size]);
  }
  return sum.toFixed(1).toString();
}

function update_progress_bar(index) {
  var checked = index;
  if ( checked === 0 ) {
    $(".progress-bar-insider").css("width", "4%");
  }
  else {
    checked = checked - 1;
    $(".progress-bar-insider").css("width", ((checked/{{$question_amount}})*96 + 4) + "%");
  }
  if (checked < {{$question_amount}}) {
    $(".progress-bar-insider").attr("data-progress", (checked + 1) + "/{{$question_amount}}");
  }
  else {
    $(".progress-bar-insider").attr("data-progress", "100% 🔥🔥🔥");

    $('#exam-section').hide();
    $('#loading-section').show();
    @this.call('result');
  }
}
Livewire.on("setTran", (event) => {
  console.log('set tran')
  $('#exam-section').hide();
  $('#loading-section').hide();
  $('#summary-section').show();
});

$(".carousel--item input[type=radio]").click(function(){
  $("#auto-con-calc").slideUp();
  $('.nav--buttons--right').trigger('click');
});

function sliderControl(less, same, more) {
  var less_slider = $(".score-slider-less");
  var same_slider = $(".score-slider");
  var more_slider = $(".score-slider-more");

  if ( same < 5.00 ) {
    same_slider.css("width", "5%");
  }
  else {
    less_slider.css("width", same + "%");
  }
  same_slider.css("left", less + "%").html(same + "%");
  less_slider.css("width", (parseFloat(less) + (parseFloat(same) / 2)) + "%").html(less + "%");
  more_slider.css("width", (parseFloat(more) + (parseFloat(same) / 2)) + "%").html(more + "%");
}


    </script>
@endpush