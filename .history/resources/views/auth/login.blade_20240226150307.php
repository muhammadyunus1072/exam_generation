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
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="../../demo1/dist/index.html" action="#">
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                            <!--end::Title-->
                            <!--begin::Subtitle-->
                            <!--end::Subtitle=-->
                        </div>
                        <!--end::Login options-->
                        <!--begin::Separator-->
                        <div class="separator separator-content my-14">
                            <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                        </div>
                        <!--end::Separator-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
                            <!--end::Email-->
                        </div>
                        <!--end::Input group=-->
                        <div class="fv-row mb-3">
                            <!--begin::Password-->
                            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
                            <!--end::Password-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <!--begin::Link-->
                            <a href="../../demo1/dist/authentication/layouts/overlay/reset-password.html" class="link-primary">Forgot Password ?</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Sign In</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Submit button-->
                        <!--begin::Sign up-->
                        <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                        <a href="../../demo1/dist/authentication/layouts/overlay/sign-up.html" class="link-primary">Sign up</a></div>
                        <!--end::Sign up-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Footer-->
                <div class="d-flex flex-stack">
                    <!--begin::Languages-->
                    <div class="me-10">
                        <!--begin::Toggle-->
                        <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                            <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="assets/media/flags/united-states.svg" alt="" />
                            <span data-kt-element="current-lang-name" class="me-1">English</span>
                            <i class="ki-duotone ki-down fs-5 text-muted rotate-180 m-0"></i>
                        </button>
                        <!--end::Toggle-->
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/united-states.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">English</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/spain.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">Spanish</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/germany.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">German</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/japan.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">Japanese</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/france.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">French</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Languages-->
                    <!--begin::Links-->
                    <div class="d-flex fw-semibold text-primary fs-base gap-5">
                        <a href="../../demo1/dist/pages/team.html" target="_blank">Terms</a>
                        <a href="../../demo1/dist/pages/pricing/column.html" target="_blank">Plans</a>
                        <a href="../../demo1/dist/pages/contact.html" target="_blank">Contact Us</a>
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Body-->
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-5">
                <div class="p-5 rounded" style="background-color: #96EFFF;">
                    <h4 class="m-0 text-center">Selamat Datang!</h4>
                    <p class="mb-5 text-center">Silahkan login dengan akun anda </p>
            
                    <form action="{{ route('login.do_login') }}" id="login-form" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <label class="text-label" for="email">Email / Username:</label>
                            <div class="input-group input-group-merge">
                                <input id="email" name="email" type="email" class="form-control form-control-prepended"
                                    placeholder="Email / Username">
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="text-label" for="password">Password:</label>
                            <div class="input-group input-group-merge">
                                <input id="password" name="password" type="password" class="form-control form-control-prepended"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary mb-5" type="submit">Login</button>
                            <br>Belum punya akun? <a class="text-body text-underline" href="{{ route('register.index') }}">Daftar!</a>
                            <br>Sudah punya akun tapi lupa password? <a class="text-body text-underline"
                                href="{{ route('password.request') }}">Lupa Password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $("#login-form").submit(function(e) {
            e.preventDefault();
            loading("show");
            // Kirim data ke server
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    var result = response.response;
                    loading("hide");

                    if (response.code == 200) {
                        Swal.fire({
                            title: result.title,
                            text: result.message,
                            icon: result.type,
                            allowOutsideClick: false,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        // window.location = '/';
                        location.reload();
                    } else if (response.code == 201) {
                        window.location =
                        `{{ route('verification.index') }}?email=${$('#email').val()}`;
                    } else {
                        Swal.fire(result.title, result.message, result.type);
                    }
                },
                error: function(xhr, request, error) {
                    loading("hide");
                    alert_error("show", xhr);
                }
            });
        });
    </script>
@endpush
