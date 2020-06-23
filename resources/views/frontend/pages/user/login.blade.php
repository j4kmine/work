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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">Masuk ke ExportKu </h3>
                    <h4 class="text-center">Buat dan Kelola Pengirimanmu</h4>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-box">
                        <form action="/action_page.php">
                            <div class="form-group">
                                <input type="email" placeholder="Alamat Email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" class="form-control" id="pwd">
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-cek">Masuk</button>
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