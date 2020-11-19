<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Paper</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{url('assets/css/app.css')}}">

</head>
<body class="light sidebar-mini sidebar-collapse">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
<div class="page parallel">
    <div class="d-flex row">
        <div class="col-md-3 white">
            <div class="p-5 mt-5">
                <img src="assets/img/basic/logo.png" alt=""/>
            </div>
            <div class="p-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                </div>
                @endif
                <h3>Welcome Back</h3>
                <p>Hey Soldier welcome back signin now there is lot of
                    new stuff waiting
                    for you</p>
                <form action="{{ route('dologin') }}" method="POST">
                    <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                        <input type="text" name="email" class="form-control form-control-lg"
                               placeholder="Email Address">
                    </div>
                    <div class="form-group has-icon"><i class="icon-user-secret"></i>
                        <input type="password" name="password" class="form-control form-control-lg"
                               placeholder="Password">
                    </div>
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Log In">
                </form>
                <br/>
                <a class="btn btn-danger btn-lg btn-block" href="{{url('register')}}">Register</a>
            </div>
        </div>
        <div class="col-md-9  height-full blue accent-3 align-self-center text-center d-none d-md-block" data-bg-repeat="false"
             data-bg-possition="center">
        </div>
    </div>
</div>
<!-- Right Sidebar -->

<!-- /.right-sidebar -->
<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<!--/#app -->
<script src="{{url('assets/js/app.js')}}"></script>

</body>
</html>

