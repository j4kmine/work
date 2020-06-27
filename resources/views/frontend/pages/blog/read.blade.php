@extends('../../../templatefrontend')


@section('content')
<style>
    .container-full {
        width: 100%;
        margin-right: auto;
        margin-left: auto;
        overflow: hidden;
    }
    
    .nopadding {
        padding: 0px;
    }
    
    .title-detail-article {
        background-color: #F5F5F5;
    }
    
    .widget-title {
        padding: 30px 40px;
        vertical-align: middle;
        margin-top: 110px;
    }
    
    .widget-title b {
        background: #C2262D;
        color: white;
        padding: 8px 17px;
        border-radius: 8px;
    }
    
    .widget-title span.name {
        font-weight: bold;
        margin-left: 5px;
        margin-right: 5px;
    }
    
    .footer-right .followSosmed {
        float: right;
        margin-bottom: 10px;
    }
    
    body .followSosmed ul,
    html .followSosmed ul {
        display: inline-block;
        vertical-align: middle;
        padding-top: 15px;
        padding-left: 0px;
    }
    
    body .followSosmed ul li,
    html .followSosmed ul li {
        margin: 0 3px;
        display: inline-block;
    }
    
    body .followSosmed ul li a[class*=facebook],
    html .followSosmed ul li a[class*=facebook] {
        background-color: #425cab;
    }
    
    body .followSosmed ul li a[class*=twitter],
    html .followSosmed ul li a[class*=twitter] {
        background-color: #71adf3;
    }
    
    body .followSosmed ul li a[class*=instagram],
    html .followSosmed ul li a[class*=instagram] {
        background-color: #e4405f;
    }
    
    body .followSosmed ul li a,
    html .followSosmed ul li a {
        display: block;
        width: 25px;
        height: 25px;
        text-align: center;
        border-radius: 50%;
        background: salmon;
    }
    
    body .followSosmed ul li a[class*=linkedin],
    html .followSosmed ul li a[class*=linkedin] {
        background-color: #33669e;
    }
    
    body .followSosmed ul li a i,
    html .followSosmed ul li a i {
        font-size: 15px;
        line-height: 25px;
        color: #fff;
    }
    
    body .followSosmed .inline-sosmed,
    html .followSosmed .inline-sosmed {
        margin-top: -10px;
        display: block;
    }
    
    body .followSosmed .inline-sosmed li,
    html .followSosmed .inline-sosmed li {
        display: block;
        margin-bottom: 10px;
        float: right;
        clear: both;
    }
    
    .body-article {
        margin-top: 50px;
    }
    
    .body-article p {
        line-height: 26px;
        font-size: 16px;
    }
    
    .body-article hr {
        margin-top: 0px;
    }
    
    .item-below {
        margin-top: 40px;
    }
    
    .widget-newsletter {
        background: #F4F0EB;
        padding: 40px 90px;
        box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.2)
    }
    
    input#dimensi {
        right: 15px;
    }
    
    .input-group-addon:last-child {
        /* border-left: 0; */
        border: 1px solid #C2262D;
        border-radius: 5px;
    }
    
    input#dimensi {
        right: 15px;
        border: 1px solid #ddd;
        border-radius: 0px;
    }
    
    .widget-secondary {
        padding: 20px 40px;
        background: #F5F5F5;
        margin-bottom: 40px;
        margin-top: 60;
        box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.2)
    }
</style>
<script>
    $(function() {
        $('.item').matchHeight({

        });
    });
</script>
<div class="container-full">
    
    <div class="row">
        <div class="col-md-6 nopadding item">
            <img src="{{url('/images/'. $blogs['blogs']['imagesdetail']['path'])}}" class="img-responsive" />
        </div>
        <div class="col-md-6 title-detail-article nopadding item">
            <div class="widget-title">
                <b>Kategori 1</b>
                <h3>{{  $blogs['blogs']['title'] }}</h3>
                <span class="by">Oleh:</span>
                <span class="name">Mister Exportir</span>
                <span class="date">05 Maret 2019</span>
                <div class="followSosmed">
                    <ul>
                        <li>
                            <a class="facebook" href="#" rel="nofollow"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a class="twitter" href="#" rel="nofollow"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a class="instagram" href="#" rel="nofollow"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a class="linkedin" href="#" rel="nofollow"><i class="fa fa-linkedin"></i></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="body-article">
    <div class="container">
        <div class="col-md-1 nopadding">
            <div class="followSosmed ">
                <ul class="inline-sosmed">
                    <li>
                        <a class="facebook" href="#" rel="nofollow"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a class="twitter" href="#" rel="nofollow"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a class="instagram" href="#" rel="nofollow"><i class="fa fa-instagram"></i></a>
                    </li>
                    <li>
                        <a class="linkedin" href="#" rel="nofollow"><i class="fa fa-linkedin"></i></a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-md-7">
            {!!  $blogs['blogs']['body'] !!}
          
            <div class="widget-secondary">
                <h3>JASA EKSPOR KACANG MEDE</h3>
                <br/>

                <p>Bagi kawan eksportir yang hendak mengekspor kacang mede ke kancah internasional namun belum dapat memenuhi persyaratan yang di tetapkan pemerintah, jangan khawatir kami dapat membantu agar pengeksporan tetap berjalan lancar dengan
                    menggunakan lisensi kami yatu MISTER EXPORTIR, selain itu, kami juga dapat membantu anda yang telah memiliki buyer di luar negeri namun belum memiliki supplier kacang mede, kami menjual juga kacang mede dengn kualitas ekspor
                    dengan jenis W320,.</p>
                <br/>
                <p>Bagi kawan eksportir yang penasaran dan membutuhkan informasi lebih lanjut dapat menghubungi kontak MISTER EXPORTIR di Whatsapp 0895 3434 04471 </p>

            </div>
            <div class="widget-newsletter">
                <form data-toggle="validator" method="post" action="{{ route('subscibe') }}">
                    <div class="input-group">
                        <input id="dimensi" type="text" class="form-control" name="email" placeholder="Masukan Email Anda..." required="true">
                        <span class="input-group-addon group-addon-resi">  <button type="submit" class="btn btn-cek"><b>Berlangganan</b></button></span>
                    </div>
                </form>
            </div>
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
            @foreach($blogs['lainnya'] as $key=>$blog)
                <div class="item-below">
                    <a href="<?php echo TextHelp::generateLink($blog);?>">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{url('/images/'.$blog['imagesdetail']['path'])}} " class="img-responsive ">
                            </div>
                            <div class="col-md-6">
                                <h4>{{ $blog['title'] }}</h4>
                                <P>05 Maret 2019</P>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
          

        </div>
        <div class="col-md-4">
            <h3>Artikel terpopuler</h3>
            <hr/>
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo url('/frontend/assets');?>/images/pic.png " class="img-responsive ">
                    <h4>Jasa Ekspor Kacang Mede</h4>
                    <P>05 Maret 2019</P>
                </div>
                <div class="col-md-6">
                    <img src="<?php echo url('/frontend/assets');?>/images/pic.png " class="img-responsive ">
                    <h4>Jasa Ekspor Kacang Mede</h4>
                    <P>05 Maret 2019</P>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo url('/frontend/assets');?>/images/pic.png " class="img-responsive ">
                    <h4>Jasa Ekspor Kacang Mede</h4>
                    <P>05 Maret 2019</P>
                </div>
                <div class="col-md-6">
                    <img src="<?php echo url('/frontend/assets');?>/images/pic.png " class="img-responsive ">
                    <h4>Jasa Ekspor Kacang Mede</h4>
                    <P>05 Maret 2019</P>
                </div>
            </div>
        </div>
    </div>
</div>


<br/>
<br/>
@endsection