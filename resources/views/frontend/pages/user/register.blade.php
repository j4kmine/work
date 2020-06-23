@extends('../../../templatefrontend',['page' => $page])


@section('content')
<style>
    .navbar-header {
        text-align: center;
        width: 100%;
    }
    
    .navbar-brand {
        float: none;
    }
    
    .logo-top {
        margin: 0 auto;
    }
    
    .navbar {
        margin-bottom: 0px;
    }
    
    section.wrapper {
        background: #F8F8F8;
    }
    
    .login-box {
        margin-top: 10px;
        background: #FFFFFF;
        padding: 30px 35px;
        border-radius: 5px;
        margin-bottom: 150px;
    }
    
    .btn-cek {
        font-weight: bold;
        padding: 5px 26px !important;
        font-size: 17px;
    }
    
    label.checkbox-inline {
        color: #C2262D;
    }
    
    .nav-tabs li {
        width: 50%;
        text-align: center;
    }
    
    ul.nav.nav-tabs {
        width: 100%;
    }
</style>
<section class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Daftar ke ExportKu </h3>
                <h4 class="text-center">Buat dan Kelola Pengirimanmu</h4>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#personal">
                            <h4>Personal</h4>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#perusahaan">
                            <h4>Perusahaan</h4>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="tab-content">
                <div id="personal" class="tab-pane fade in active">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="login-box">
                            <form action="/action_page.php">
                                <div class="form-group">
                                    <input type="text" placeholder="Nama Depan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Nama Belakang" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="E-mail" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="No.Hp" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Negara" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Password" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Ulangi Password" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="">Saya menyetujui syarat dan ketentuan dan pernyataan privasi MisterExportir
                                        </label>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="">Saya bersedia menerima penawaran dan berita terbaru tentang produk
                                        </label>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 text-center'>
                                        <button type="button" class="btn btn-cek">Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="perusahaan" class="tab-pane fade in ">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="login-box">
                            <form action="/action_page.php">
                                <div class="form-group">
                                    <input type="text" placeholder="Nama Perusahaan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Nama Depan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Nama Belakang" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="E-mail" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="No.Hp" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Negara" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Password" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Ulangi Password" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="">Saya menyetujui syarat dan ketentuan dan pernyataan privasi MisterExportir
                                        </label>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="">Saya bersedia menerima penawaran dan berita terbaru tentang produk
                                        </label>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 text-center'>
                                        <button type="button" class="btn btn-cek">Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection