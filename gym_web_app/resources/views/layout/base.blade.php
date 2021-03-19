<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Gym Management System</title>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('/css/v1_app.css') }}">
    @yield('css')

</head>

<body>


    @yield('modal')


    {{-- main --}}
    <header class="navbar navbar-dark navbar-full bg-info doc-navbar-default">
        <button id="drawer_switcher" aria-controls="navdrawerDefault" aria-expanded="false"
            aria-label="Toggle Navdrawer" class="navbar-toggler" data-target="#navdrawerDefault"
            data-toggle="navdrawer"><span class="navbar-toggler-icon"></span></button>
        <span class="navbar-brand ">Gym Management System</span>
        <div class="ml-auto">
            <a href="/notifications">
                <i class="material-icons text-white">notifications</i>
            </a>
            <a href="/logout" class="ml-2">
                <i class="material-icons text-white">logout</i>
            </a>
        </div>

        <div>
        </div>
    </header>

    <div aria-hidden="true" class="navdrawer  " id="navdrawerDefault" tabindex="-1">
        <div class="navdrawer-content  bg-dark">

            <div class="mt-4">
                <img src="/images/logo.png" class="img-fluid d-block m-auto" style="height:80px;">
            </div>

            <nav class="navdrawer-nav text-uppercase">
                <a class="btn btn-danger nav-item nav-link text-left" href="/">
                    <i class="material-icons mr-3">dashboard</i>
                    Dashboard
                </a>
                <a class="btn btn-danger nav-item nav-link text-left mt-2" href="/members">
                    <i class="material-icons mr-3">group</i>
                    Members
                </a>

                <a class="btn btn-danger nav-item nav-link text-left mt-2" href="/trainers">
                    <i class="material-icons mr-3">group</i>
                    Trainers
                </a>
                <a class="btn btn-danger nav-item nav-link text-left mt-2" href="/schedule">
                    <i class="material-icons mr-3">calendar_today</i>
                    Schedule
                </a>
                <a class="btn btn-danger nav-item nav-link text-left mt-2" href="/attendance">
                    <i class="material-icons mr-3">perm_contact_calendar</i>
                    Attendance
                </a>
                <a class="btn btn-danger nav-item nav-link text-left mt-2" href="/payment">
                    <i class="material-icons mr-3">credit_card</i>
                    Payment
                </a>
            </nav>
            <div class="navdrawer-divider"></div>

            <div class="bg-danger text-center text-white px-2  ">
                <div  style="font-size: 28px;;font-weight: 600">
                    Today
                </div>
                <div  style="font-size: 18px;font-weight: 700">
                    {{ Carbon\Carbon::now()->toDateString() }}
                </div>
                {{-- <div class="mt-1" style="font-size: 18px;">
                    {{ Carbon\Carbon::now()->hour  }}:{{ Carbon\Carbon::now()->minute  }}
                </div> --}}
            </div>



        </div>
    </div>

    <div class="container-fluid mt-3">

        @yield('content')
        <div class="my-4"></div>
    </div>

    {{-- !ENDS main --}}


    {{-- script --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.plugins.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('/js/v1_app.js') }}"></script>
    @yield('js')

</body>

</html>
