@extends('../../../templatefrontend',['page' => $page])


@section('content')
<style>
 .login-box {
        margin-top: 50px;
        background: #FFFFFF;
        padding: 30px 35px;
        margin-bottom: 150px;
    }
    
    .btn-cek {
        font-weight: bold;
        padding: 5px 26px !important;
        font-size: 17px;
    }
    
    .forgot a {
        color: #C2262D;
    }
</style>
<section class="wrapper">
    @section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
    @endif
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">Masuk ke ExportKu </h3>
                    <h4 class="text-center">Buat dan Kelola Pengirimanmu</h4>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-box">
                        <form data-toggle="validator" method="post" action="{{ route('loginuser') }}">
                            <div class="form-group">
                                <input type="email" placeholder="Alamat Email" name="email" class="form-control" id="email" required="true">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" name="password" class="form-control" id="pwd" required="true">
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-cek">Masuk</button>
                                </div>
                                <div class="col-md-9">
                                    <span class="forgot">
                                        <div>
                                           <a href="<?php echo url('/userforgot')?>"> Lupa Password</a>
                                           <br/>
                                           <a href="<?php echo url('/userregister')?>">  Belum punya akun? Daftar sekarang!</a>
                                        </div>
                                       
                                       
                                    </span>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection