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
                    <h3 class="text-center">Reset Password </h3>
                    <h4 class="text-center">Lupa Password akun ExportKu </h4>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-box">
                        <form action="/action_page.php">
                            <div class="form-group">
                                <input type="email" placeholder="Alamat Email" class="form-control" id="email">
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-cek">Reset</button>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection