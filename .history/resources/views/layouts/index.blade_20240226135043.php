<html>
    <!--begin::Head-->
    <head>
        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <!--end::Fonts-->

        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Vendor Stylesheets-->

        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body>
        <div class="table-responsive">
            <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                    <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                    <tr>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12</td>
                        <td>$86,000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
            </table>
        </div>


        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
        {{-- begin::Livewire --}}
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
        {{-- end::Livewire --}}
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>