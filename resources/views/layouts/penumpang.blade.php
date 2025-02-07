<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Travelindo</title>
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            @guest
            <div class="container d-flex justify-content-end mt-3">
                <li class="nav-item active text-light">
                    <i class="fas fa-plane-departure fa-2x"></i>
                </li>
            </div>
            @endguest

            @auth
                <li class="nav-item active mt-2">
                    <h2 class="text-center text-light font-weight-bold"
                        style="font-size: 1.5rem; letter-spacing: 2px; text-transform: uppercase; padding: 10px 0;">
                        <i class="fas fa-plane-departure"></i>
                        Menu
                    </h2>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('penumpang.pesanan.index') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Riwayat Pesanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('penumpang.pesanan.create') }}">
                        <i class="fas fa-fw fa-calendar-check"></i>
                        <span>Pesan Tiket</span>
                    </a>
                </li>
            @endauth
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav d-flex justify-content-between w-100 align-items-center">
                        @guest
                            <h2 class="text-center text-black font-weight-bold"
                                style="font-size: 1.5rem; letter-spacing: 2px; text-transform: uppercase; padding: 10px 0;">
                                Travelindo
                            </h2>
                        @endguest

                        @auth
                            <li class="nav-item">
                                <h2 class="text-black font-weight-bold m-0"
                                    style="font-size: 1.5rem; letter-spacing: 2px; text-transform: uppercase;">
                                    Travelindo
                                </h2>
                            </li>
                            <li class="nav-item dropdown no-arrow ml-auto">
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
