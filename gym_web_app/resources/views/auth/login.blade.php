<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('/css/v1_app.css') }}">

    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .vid-container {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .bgvid {
            position: absolute;
            left: 0;
            top: 0;
            width: 100vw;
        }

        .inner-container {
            width: 400px;
            height: 400px;
            position: absolute;
            top: calc(50vh - 200px);
            left: calc(50vw - 200px);
            overflow: hidden;
        }

        .bgvid.inner {
            top: calc(-50vh + 200px);
            left: calc(-50vw + 200px);
            filter: url("data:image/svg+xml;utf9,<svg%20version='1.1'%20xmlns='http://www.w3.org/2000/svg'><filter%20id='blur'><feGaussianBlur%20stdDeviation='10'%20/></filter></svg>#blur");
            -webkit-filter: blur(10px);
            -ms-filter: blur(10px);
            -o-filter: blur(10px);
            filter: blur(10px);
        }

        .box {
            position: absolute;
            height: 100%;
            width: 100%;
            font-family: Helvetica;
            color: #fff;
            background: rgba(0, 0, 0, 0.4);
            padding: 30px 0px;
        }

        .box h1 {
            text-align: center;
            margin: 30px 0;
            font-size: 30px;
        }

        .box input {
            display: block;
            width: 300px;
            margin: 20px auto;
            padding: 15px;
            background: rgba(0, 0, 0, 0.2);
            color: #fff;
            border: 0;
        }

        .box input::placeholder {
            color: #fff;
        }

        .box input:focus,
        .box input:active,
        .box button:focus,
        .box button:active {
            outline: none;
        }

        .box button {
            background: #2ecc71;
            border: 0;
            color: #fff;
            padding: 10px;
            font-size: 20px;
            width: 330px;
            margin: 20px auto;
            display: block;
            cursor: pointer;
        }

        .box button:active {
            background: #27ae60;
        }

        .box p {
            font-size: 14px;
            text-align: center;
        }

        .box p span {
            cursor: pointer;
            color: #666;
        }

    </style>
</head>

<body>




    <div class="vid-container" style="background: url({{ asset('images/bg_login.jpg') }})">
        <div class="inner-container">
            <div class="box">
                <div class="login-title text-center pt-5">
                    <div>
                        GYM
                    </div>
                </div>

                      <form action="/login" method="post">
                {{ csrf_field() }}
                <input type="text" name="username" placeholder="Username" style="color: white" />
                <input type="password" name="password" placeholder="Password" />

                  @if ($errors->any())
                    <div class="alert alert-danger error-container mt-2" style="background-color: #ffcdd2;color: rgba(0,0,0,.87);padding:10px 20px;margin-bottom:20px;">
                        <div class="alert alert-danger">
                            <ul class="errors">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif


                <button  type="submit"  style="width: 50%">Login</button>
            </form>
            </div>
        </div>
    </div>


</body>

</html>
