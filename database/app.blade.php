{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>City - Tour</title>
    <link rel="icon" type="image/x-icon" href="../src/assets/img/favicon.ico" />
    <link href="{{asset('/layouts/collapsible-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{asset('/layouts/collapsible-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" /> --}}
    <script src="{{asset('/layouts/collapsible-menu/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/layouts/collapsible-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('/layouts/collapsible-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" /> --}}
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" /> --}}
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('/src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" /> --}}
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <link rel="stylesheet" type="text/css" href="{{ asset('/src/plugins/src/table/datatable/datatables.css')}}">
    <link href="{{ asset('/src/assets/css/light/components/modal.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/css/intlTelInput.css" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/src/plugins/css/light/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" href="{{ asset('/src/plugins/src/filepond/filepond.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/src/plugins/src/filepond/FilePondPluginImagePreview.min.css')}}">
    <link href="{{ asset('/src/plugins/src/notification/snackbar/snackbar.min.css')}}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('/src/plugins/src/sweetalerts2/sweetalerts2.css')}}">
    <link href="{{ asset('/src/plugins/css/light/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/src/assets/css/light/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/src/assets/css/light/elements/alert.css')}}">
    <link href="{{ asset('/src/plugins/css/light/sweetalerts2/custom-sweetalert.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/src/plugins/css/light/notification/snackbar/custom-snackbar.css')}}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/src/assets/css/light/forms/switches.css')}}">
    <link href="{{ asset('/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/src/assets/css/style.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ asset('/src/assets/css/light/users/account-setting.css')}}" rel="stylesheet" type="text/css" />

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('/src/assets/css/light/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('/src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="{{ asset('/src/assets/css/dark/users/user-profile.css')}}" rel="stylesheet" type="text/css" /> --}}
    <!--  END CUSTOM STYLE FILE  -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    @livewireStyles

</head>

<body class="layout-boxed alt-menu">
    
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('layouts.navbar.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
       @include('layouts.sidebar.sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

            <div class="layout-px-spacing">
                {{ $slot }}
            </div>
            
            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">2022</span> <a target="_blank" href="https://designreset.com/cork-admin/">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
            <!--  END FOOTER  -->

        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('/layouts/collapsible-menu/app.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/src/plugins/src/highlight/highlight.pack.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('/src/plugins/src/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/src/assets/js/dashboard/dash_1.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script src="{{ asset('/src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('/src/assets/js/custom.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/src/assets/js/apps/invoice-list.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script src="{{ asset('/src/plugins/src/filepond/filepond.min.js')}}"></script>
    <script src="{{ asset('/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js')}}"> </script>
    <script src="{{ asset('/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/notification/snackbar/snackbar.min.js') }}"></script>
    <script src="{{ asset('/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('/src/assets/js/users/account-settings.js') }}"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('/src/assets/js/scrollspyNav.js') }}"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'success') }}"
            
            switch (type) {
                case 'info':

                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        @endif
       
    </script>
    
</body>
</html>
