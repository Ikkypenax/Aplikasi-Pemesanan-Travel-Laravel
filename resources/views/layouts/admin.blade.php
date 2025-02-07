<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Travelindo</title>
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top" class="bg-gray-200">
    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column bg-gray-200">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav mr-auto ml-0">
                        @auth
                            <li class="nav-item dropdown no-arrow ml-5">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown"
                                    role="button" data-toggle="dropdown">
                                    <i class="fas fa-plane-departure fa-fw mr-1"></i>
                                    <strong>Menu Travel</strong>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.jadwal_travel.index') }}">
                                        <i class="fas fa-calendar-day fa-sm text-black-400"></i>
                                        Jadwal Travel</a>
                                    <a class="dropdown-item" href="{{ route('admin.laporan.index') }}">
                                        <i class="fas fa-file-alt fa-sm text-black-400"></i>
                                        Laporan</a>
                                    <a class="dropdown-item" href="{{ route('admin.riwayat.index') }}">
                                        <i class="fas fa-users fa-sm text-black-400"></i>
                                        Riwayat Penumpang</a>
                                </div>
                            </li>

                        @endauth
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item dropdown no-arrow mr-3">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown">
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('sbadmin2/img/undraw_profile.svg') }}">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </nav>


                <div class="container-fluid">
                    @yield('content')
                </div>
                
            </div>
        </div>
    </div>

    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert-success").fadeOut(500); 
            }, 2000);
        });
    </script>
</body>

</html>
