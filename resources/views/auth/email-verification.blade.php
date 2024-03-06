@extends('auth.layout')

@section('body-class', 'layout-default layout-login-image')

@section('content')

    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <!--begin::Wrapper-->
        <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                    <!--begin::Form-->
                    <form action="{{ route('verification.store') }}" id="login-form" method="post" class="form w-100" novalidate="novalidate">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">Email Verification</h1>
                            <!--end::Title-->
                            <!--begin::Subtitle-->
                            <!--end::Subtitle=-->
                        </div>
                        <!--end::Login options-->
                        <!--begin::Separator-->
                        <div class="separator separator-content my-14">
                            <span class="text-gray-500 fw-semibold fs-7">Please check your email</span>
                        </div>
                        <!--end::Separator-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" value="{{ $email }}" readonly/>
                            <!--end::Email-->
                        </div>
                        <div class="fv-row mb-8">
                            <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-danger" class="reload" id="reload">
                                    &#x21bb;
                                </button>
                            </div>
                        </div>
                        <div class="fv-row mb-8">
                            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <span id='btn-submit-info'></span>
                            <button type="submit" id="btn-submit" class="btn btn-primary" disabled>
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Resend Email Verification</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Submit button-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Body-->
@endsection

@push('js')
    <script type="text/javascript">
        function getCaptcha(){
            $.ajax({
                type: 'GET',
                url: '{{route('reload_captcha')}}',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        };
        var interval_send_email;
        var time_send_email;

        $(() => {
            disable_send_email();
        });

        function disable_send_email() {
            time_send_email = 30;
            $('#btn-submit').attr('disabled', true);
            $('#btn-submit-info').text(`Kirim Ulang Email Dalam ${time_send_email} Detik`);

            interval_send_email = setInterval(() => {
                time_send_email -= 1;

                if (time_send_email == 0) {
                    clearInterval(interval_send_email);
                    $('#btn-submit-info').text(``);
                    $('#btn-submit').attr('disabled', false);
                    $('#reload').trigger('click');
                } else {
                    $('#btn-submit-info').text(`Kirim Ulang Email Dalam ${time_send_email} Detik`);
                }
            }, 1000);
        }

        $('#reload').click(function() {
            getCaptcha();
        });

        $("#login-form").submit(function(e) {
            e.preventDefault();
            // Kirim data ke server
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    var result = response.response;

                    if (response.code == 201) {
                        Swal.fire({
                            title: result.title,
                            text: result.message,
                            icon: result.type,
                        });
                        disable_send_email();
                    } else if (response.code == 200) {
                        Swal.fire({
                            title: result.title,
                            text: result.message,
                            icon: result.type,
                            allowOutsideClick: false,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        window.location = "{{ route('login.index') }}";
                    } else {
                        Swal.fire(result.title, result.message, result.type);
                    }

                    getCaptcha();
                },
                error: function(xhr, request, error) {
                    alert_error("show", xhr);

                    getCaptcha();
                }
            });
        });
    </script>
@endpush


