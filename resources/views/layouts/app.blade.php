<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="description" content="Template Gull">
    <meta name="keywords" content="admin template, Gull admin template">
    <meta name="author" content="Oki">
    <title>{{ env('APP_NAME')}} - @yield('title')</title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('app-assets/images/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('app-assets/images/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('app-assets/images/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('app-assets/images/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('app-assets/images/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('app-assets/images/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('app-assets/images/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('app-assets/images/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('app-assets/images/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('app-assets/images/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('app-assets/images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('app-assets/images/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('app-assets/images/favicon/favicon-16x16.png')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('app-assets/images/favicon/favicon.ico')}}">
    
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('app-assets/css/themes/lite-purple.css')}}" rel="stylesheet" />
    <link href="{{asset('app-assets/css/plugins/perfect-scrollbar.css')}}" rel="stylesheet" />
    {{-- <link href="{{asset('app-assets/css/plugins/fontawesome-5.css')}}" rel="stylesheet"  /> --}}
    <link href="{{asset('app-assets/css/plugins/metisMenu.min.css')}}" rel="stylesheet" />
    <link href="{{asset('app-assets/css/plugins/datatables.min.css')}}" rel="stylesheet"  />
    <link href="{{asset('app-assets/css/select/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('app-assets/css/plugins/forms/form-validation.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/extensions/sweetalert2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('assets/css/extensions/jstree.min.css')}}" rel="stylesheet" />
    <link href="{{asset('app-assets/css/plugins/extensions/ext-component-tree.min.css')}}" rel="stylesheet" type="text/css" >
        
    <style>
        /* kalo udah di select jangan keluar lagi di list options */
        .select2-dropdown .select2-results__option[aria-selected=true] {
            display: none;
        }
        .table-responsive {
            overflow:auto;
        }
        th, td { white-space: nowrap; }

    </style>
    @yield('styles')
</head>

<body class="text-left">
    @include('partials.loading-spinner')
    <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
        @include('layouts.sidepanel')
        <div class="switch-overlay"></div>
        <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
            @include('layouts.header')
            <div class="main-content pt-4">
                @yield('breadcrumb')
                @yield('content')
                @include('partials.sessionTimeout')
                <div class="sidebar-overlay open"></div>
                <div class="flex-grow-1"></div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    <script src="{{asset('app-assets/js/plugins/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugins/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/tooltip.script.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/script.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/script_2.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/sidebar.large.script.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugins/feather.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugins/metisMenu.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/layout-sidebar-vertical.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugins/datatables.min.js')}}"></script>
    <script src="{{asset('app-assets/js/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugins/forms/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/extensions/ext-component-tree.min.js')}}"></script>
    <script src="{{asset('assets/js/extensions/jstree.min.js')}}"></script>
    
            
    <script type="text/javascript">
      
        let configku = {
            env: {
              inActiveTime:'{{ env('APP_INACTIVE_TIME') }}',
              autoLogoutTime:'{{ env('APP_AUTO_LOGOUT_TIME') }}',
              autoLogout:'{{ route('logout') }}'
            }
        };

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').click(function () {
                $('[data-toggle="tooltip"]').tooltip("hide");
            });
        });

    </script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    @yield('scripts')

</body>
</html>