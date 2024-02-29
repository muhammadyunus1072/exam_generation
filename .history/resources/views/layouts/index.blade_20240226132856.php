<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link type="text/css" href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    @stack('css')
    @livewireStyles
</head>

<body class="layout-app ">

    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>

    <!-- Drawer Layout -->
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <div class="navbar navbar-expand pr-0 navbar-light border-bottom-2" id="default-navbar" data-primary>

                <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0" type="button"
                    data-toggle="sidebar">
                    <span class="material-icons">short_text</span>
                </button>

                <a href="index.html" class="navbar-brand mr-16pt d-lg-none">
                    <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
                        <span class="avatar-title rounded bg-white">
                            <img alt="logo" class="img-fluid" src="{{ asset('ic_logo.png') }}" />
                        </span>
                    </span>
                </a>

                <div class="flex"></div>

                <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex align-items-center dropdown-toggle"
                            data-toggle="dropdown" data-caret="false">
                            <span class="avatar avatar-sm mr-8pt2">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="material-icons">account_box</i>
                                </span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header"><strong>Account</strong></div>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>

        <!-- Drawer -->
        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>
                    @include('admin.layouts.sidebar')
                </div>
            </div>
        </div>

        @yield('filter')
    </div>

    @yield('modal')

    
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>

    @stack('js')

    @livewireScripts

    <script>
        window.livewire.on('onSuccessSweetAlert', (message) => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: message,
            });
        });

        window.livewire.on('onFailSweetAlert', (message) => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: message,
            });
        });
        window.livewire.on('consoleLog', (data) => {
            console.log(data)
        });
    </script>

</body>

</html>
