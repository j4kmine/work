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
        padding: 0;
    }

    .title-detail-article {
        background-color: #F5F5F5;
    }

    .widget-title {
        padding: 0 0 10px;
        vertical-align: middle;
        margin-top: 8px;
    }

    .widget-title h1 {
        font-weight: 700;
        font-size: 4rem;
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
        padding-left: 0;
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
        margin-top: 0;
    }

    .item-below {
        margin-top: 40px;
    }

    .widget-newsletter {
        background: #F4F0EB;
        padding: 40px 90px;
        box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.2);
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
        border-radius: 0;
    }

    .widget-secondary {
        padding: 20px 40px;
        background: #F5F5F5;
        margin-bottom: 40px;
        margin-top: 60;
        box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.2);
    }

    button.btn.btn-cek,
    button.btn.btn-cek:active,
    button.btn.btn-cek:hover {
        background: #B3373D;
        border: 3px solid #B3373D;
    }

    .input-group-addon:last-child {
        border: 1px solid #B3373D;
    }

    .navbar-form-search {
        border: 1px solid var(--grey-2, #DEDEDE);
        border-radius: 4px;
        padding: 0;
        margin-top: 0;
        margin-bottom: 0;
    }

    @media (min-width: 768px) {
        .navbar-form .form-control {
            display: inline-block;
            width: 100%;
            vertical-align: middle;
        }
    }

    @media (min-width: 768px) {
        .navbar-form .form-control {
            display: inline-block;
            width: 100%;
            vertical-align: middle;
        }
    }

    .navbar-form-search button,
    .navbar-form-search input {
        border: none;
        box-shadow: none;
    }

    .flex-grow-1 {
        flex-grow: 1 !important;
    }

    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        -webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
    }

    button,
    input,
    select,
    textarea {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }

    input {
        line-height: normal;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
        color: inherit;
        font: inherit;
        margin: 0;
    }

    .navbar-form-search button,
    .navbar-form-search input {
        border: none;
        box-shadow: none;
    }

    .btn-search {
        position: absolute;
        top: 4px;
        right: 16px;
        font-size: 22px;
        background: 0 0;
        border: none;
        color: #aaa;
    }

    button,
    input,
    select,
    textarea {
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }

    button,
    html input[type=button],
    input[type=reset],
    input[type=submit] {
        -webkit-appearance: button;
        cursor: pointer;
    }

    button,
    select {
        text-transform: none;
    }

    button {
        overflow: visible;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
        color: inherit;
        font: inherit;
        margin: 0;
    }

    .glyphicon {
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: "Glyphicons Halflings";
        font-style: normal;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .glyphicon-search:before {
        content: "\e003";
    }

    .hidden {
        display: none !important;
    }

    .btn-default {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }

    .mb-4,
    .my-4 {
        margin-bottom: 1.5rem !important;
    }

    .d-flex {
        display: flex !important;
    }

    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    main,
    menu,
    nav,
    section,
    summary {
        display: block;
    }

    .article--video .content-image {
        margin-left: 1rem;
    }

    .mr-3,
    .mx-3 {
        margin-right: 1rem !important;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .flex-120 {
        flex: 0 0 120px;
    }

    .position-relative {
        position: relative;
    }

    .video-playlist .content-image img {
        margin-top: 10%;
    }

    .img-fullwidth {
        width: 100%;
        height: auto;
    }

    img {
        vertical-align: middle;
    }

    img {
        border: 0;
    }

    h3.content-title.content-title--detail-list.mb-0 {
        color: #444444;
        font-weight: 800;
    }

    .mb-0,
    .my-0 {
        margin-bottom: 0 !important;
    }

    .content-title {
        line-height: 1.4;
    }

    .content-title--detail-list {
        font-size: 14px;
        line-height: 1.2;
    }

    .media-explainer {
        color: #444444;
    }

    .fs-12 {
        font-size: 12px !important;
    }

    .ads {
        margin-top: 10%;
    }

    .big-hero {
        background: #111 url("{{url('/images/'. $blogs['blogs']['imagesdetail']['path'])}}") center center no-repeat fixed;
        background-size: cover;
        background-attachment: unset;
        position: relative;
        padding: 30px 0;
        margin-bottom: 0;
        height: calc(85vh - 120px);
    }

    .group-addon-resi {
        background-color: #B3373D;
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
        <div class="col-md-12 nopadding item big-hero">
        </div>
    </div>
</div>
<div class="body-article">
    <div class="container">
        <div class="col-md-1 nopadding">
            <div class="followSosmed ">
                <ul class="inline-sosmed">
                    <li>
                        <a class="facebook" href="#" rel="nofollow">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a class="twitter" href="#" rel="nofollow">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a class="instagram" href="#" rel="nofollow">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a class="linkedin" href="#" rel="nofollow">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-md-7">
            <div class="widget-title">
                <b>Kategori</b>
                <h1>{{  $blogs['blogs']['title'] }}</h1>
                <span class="by">Oleh:</span>
                <span class="name">Mister Exportir</span>
                <span class="date">05 Maret 2019</span>
            </div>

            {!!  $blogs['blogs']['body'] !!}

            <div class="widget-secondary">
                <h3>JASA EKSPOR KACANG MEDE</h3>
                <br />

                <p>Bagi kawan eksportir yang hendak mengekspor kacang mede ke kancah internasional namun belum dapat memenuhi persyaratan yang di tetapkan pemerintah, jangan khawatir kami dapat membantu agar pengeksporan tetap berjalan lancar dengan
                    menggunakan lisensi kami yatu MISTER EXPORTIR, selain itu, kami juga dapat membantu anda yang telah memiliki buyer di luar negeri namun belum memiliki supplier kacang mede, kami menjual juga kacang mede dengn kualitas ekspor
                    dengan jenis W320,.</p>
                <br />
                <p>Bagi kawan eksportir yang penasaran dan membutuhkan informasi lebih lanjut dapat menghubungi kontak MISTER EXPORTIR di Whatsapp 0895 3434 04471 </p>

            </div>
            <div class="widget-newsletter hidden-xs">
                <form data-toggle="validator" method="post" action="{{ route('subscibe') }}">
                    <div class="input-group">
                        <input id="dimensi" type="text" class="form-control" name="email" placeholder="Masukan Email Anda..." required="true">
                        <span class="input-group-addon group-addon-resi">  <button type="submit" class="btn btn-cek"><b>Berlangganan</b></button></span>
                    </div>
                </form>
            </div>
            <div class="visible-xs-block">
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

            <br>
            <br>
            <h3>Artikel Terkait</h3>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <a href="#">
                        <img src="{{url('frontend/assets')}}/images/pic.png " class="img-responsive ">
                        <h4>Jasa Ekspor Kacang Mede</h4>
                    </a>
                    <P>05 Maret 2019</P>
                </div>
                <div class="col-md-6">
                    <a href="#">
                        <img src="{{url('frontend/assets')}}/images/pic.png " class="img-responsive ">
                        <h4>Jasa Ekspor Kacang Mede</h4>
                    </a>
                    <P>05 Maret 2019</P>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="#">
                        <img src="{{url('frontend/assets')}}/images/pic.png " class="img-responsive ">
                        <h4>Jasa Ekspor Kacang Mede</h4>
                    </a>
                    <P>05 Maret 2019</P>
                </div>
                <div class="col-md-6">
                    <a href="#">
                        <img src="{{url('frontend/assets')}}/images/pic.png " class="img-responsive ">
                        <h4>Jasa Ekspor Kacang Mede</h4>
                    </a>
                    <P>05 Maret 2019</P>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="search-wrapper">
                <div class="search-container">
                    <form class="navbar-form navbar-form-search form-inline d-flex" role="search" name="searchform" method="post" action="" onsubmit="doSearch();return false;">
                        <input type="text" class="form-control search-input flex-grow-1" id="inputSearch" value="" placeholder="Search">
                        <button type="submit" class="btn-search" id="search-button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </form>
                    <button type="button" class="btn btn-default close-icon hidden" id="search-close">
                        <i class="glyphicon glyphicon-remove"></i>
                    </button>
                </div>
            </div>
            <h3>Artikel Terbaru</h3>
            <hr />
            <div class="video-playlist custom-scrollbar">
                @foreach($blogs['lainnya'] as $key=>$blog2)
                <article class="article article--video d-flex mb-4">
                    <div class="content-image scale mb-3 flex-120 position-relative mr-3">
                        <a href="<?php echo TextHelp::generateLink($blog2);?>">
                            <img class="img-fullwidth rounded" src="{{url('/images/'.$blog2['imagesdetail']['path'])}}" alt="Image title">
                        </a>
                    </div>
                    <div class="content-text">
                        <a href="<?php echo TextHelp::generateLink($blog2);?>">
                            <h3 class="content-title content-title--detail-list mb-0">{{ $blog2['title'] }}</h3>
                        </a>
                        <div class="fs-12 media-explainer">05 Maret 2019</div>
                    </div>
                </article>
                @endforeach
            </div>
            <h3>Video Terbaru</h3>
            <hr />
            <div>
                <a href="#">
                    <img class="img-fullwidth rounded" src="{{url('frontend/assets')}}/images/pic.png" alt="Image title">
                </a>
                <div class="content-text">
                    <a href="#">
                        <h3 class="content-title content-title--detail-list mb-0">Mengenjot Ekspor Perikanan dan Pertanian</h3>
                    </a>
                    <div class="fs-12 media-explainer">05 Maret 2019</div>
                </div>
            </div>
            <div class="ads">
                <img class="img-fullwidth rounded" src="{{url('frontend/assets')}}/images/pic.png" alt="Image title">
            </div>
            <div class="ads">
                <img class="img-fullwidth rounded" src="{{url('frontend/assets')}}/images/pic.png" alt="Image title">
            </div>
        </div>
    </div>
</div>

<br />
<br />
@endsection