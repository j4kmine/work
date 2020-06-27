@extends('../../../templatefrontend',['page' => $page])



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
                            <form data-toggle="validator" method="post" action="{{ route('registeruser') }}">
                                <div class="form-group">
                                    <input type="text" name="nama_depan" placeholder="Nama Depan" value="{{ old('nama_depan') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="nama_belakang"  placeholder="Nama Belakang" value="{{ old('nama_belakang') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="email"   name="email"  placeholder="E-mail" value="{{ old('email') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="nohp"  placeholder="No.Hp" value="{{ old('nohp') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="negara"  placeholder="Negara" value="{{ old('negara') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"  placeholder="Password" class="form-control" required="true" id="pwd">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation"  placeholder="Ulangi Password" class="form-control" required="true" id="pwd">
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="" required>Saya menyetujui syarat dan ketentuan dan pernyataan privasi MisterExportir
                                        </label>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="" required>Saya bersedia menerima penawaran dan berita terbaru tentang produk
                                        </label>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 text-center'>
                                        <button type="submit" class="btn btn-cek">Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="perusahaan" class="tab-pane fade in ">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="login-box">
                            <form data-toggle="validator" method="post" action="{{ route('registeruser') }}">
                                <div class="form-group">
                                    <input type="text" placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan') }}"  class="form-control" reguired >
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Nama Depan" value="{{ old('nama_depan') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Nama Belakang" value="{{ old('nama_belakang') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="email"  placeholder="E-mail" value="{{ old('email') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="No.Hp" value="{{ old('nohp') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Negara" value="{{ old('negara') }}"  class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Password" class="form-control" required="true" id="pwd">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Ulangi Password" class="form-control" required="true" id="pwd">
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="" required>Saya menyetujui syarat dan ketentuan dan pernyataan privasi MisterExportir
                                        </label>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="" required>Saya bersedia menerima penawaran dan berita terbaru tentang produk
                                        </label>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 text-center'>
                                        <button type="submit" class="btn btn-cek">Daftar</button>
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