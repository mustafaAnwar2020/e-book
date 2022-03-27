<!DOCTYPE html>

<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-book</title>


    <style type="text/css">
        .dropdown-toggle {
            height: 40px;
            width: 400px !important;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- CoreUI CSS -->
    <link href="{{ URL::asset('css/profile.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/shop.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/bootstrap-multiselect.css') }}" rel="stylesheet" />

    <link href="https://unpkg.com/@coreui/coreui@3.4/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



</head>

<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-lg-down-none">
            E-Book
        </div>
        @include('partials.menu')
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
                <i class="fas fa-fw fa-bars"></i>
            </button>
            <a class="c-header-brand d-lg-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="assets/brand/coreui.svg#full"></use>
                </svg>
            </a>
            @include('partials.user-dropdown')



        </header>
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                        @yield('content')
                    </div>
                </div>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </main>
        </div>
    </div>
    <script src="{{ URL::asset('js/custom/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/custom/cart.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
    {{-- <script src="https://unpkg.com/@popperjs/core@2"></script> --}}
    {{-- <script src="https://unpkg.com/@coreui/coreui@3.4/dist/js/coreui.min.js"></script> --}}
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    {{-- <script src="{{ URL::asset('js/custom/jquery.number.min.js') }}"></script> --}}
    <script src="{{ URL::asset('js/bootstrap-multiselect.js') }}"></script>

    <script type="text/javascript">
        $('#example-single').multiselect();
    </script>

    <script type="text/javascript">
        $('#example-multiple-selected').multiselect();
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
        CKEDITOR.config.language = "{{ app()->getlocale() }}";
        CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
        CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;
    </script>



</body>

</html>
