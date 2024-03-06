@extends('auth.layout')

@section('body-class', 'layout-default layout-login-image')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-5">
                <div class="bg-light p-5 rouded">
                    <h4 class="m-0 text-center">Selamat Datang!</h4>
                    <p class="mb-5 text-center">Silahkan login dengan akun anda </p>
            
                    <form action="{{ route('login.do_login') }}" id="login-form" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="text-label" for="email">Email:</label>
                            <div class="input-group input-group-merge">
                                <input id="email" name="email" type="email" class="form-control form-control-prepended"
                                    placeholder="Email">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="far fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-label" for="password">Password:</label>
                            <div class="input-group input-group-merge">
                                <input id="password" name="password" type="password" class="form-control form-control-prepended"
                                    placeholder="Password">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fa fa-key"></span>
                                    </div>
                                </div>
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
