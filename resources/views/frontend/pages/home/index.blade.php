@extends('../../../templatefrontend')


@section('content')
<script>
    $(document).ready(function() {
        $("#id_daerah").select2({
            placeholder: "Kota Tujuan",
            initSelection: function(element, callback) {

            },
            minimumInputLength: 2,
            ajax: {
                url: 'api/listkotanegara',
                dataType: 'json',
                data: function(term, page) {
                    return {
                        q: term
                    };
                },
                results: function(data, page) {

                    return {
                        results: data[0].data
                    };
                },
                cache: false
            },
        }).on("change", function(e) {
            $('#daerah_text').val($('.select2-chosen').text());

        });
        $("#cekongkir").click(function() {
            $.ajax({
                type: "post",
                url: "api/cekongkir",
                data: JSON.stringify({
                    "panjang": $("#panjang").val(),
                    "lebar": $("#lebar").val(),
                    "tinggi": $("#tinggi").val(),
                    "destination": $("#id_daerah").val(),
                    "tipe_pengiriman": $('#tipe_pengiriman').find(":selected").val(),
                    "dimensi": $("#dimensi").val()
                }),
                contentType: "application/json",
                dataType: "json",
                success: function(data) {
                    console.log(data)
                    $("#status").show()
                    $(".widget-price").show()
                    $("#volume").text(data.paket.volume)
                    $("#berat").text(data.paket.weight)
                    var tipe = $('#tipe_pengiriman').find(":selected").val()
                    if (tipe == 1) {
                        $(".tipe_delivery").text("Air Freight")
                        $(".icon-new").attr("src", "{{url('frontend/assets')}}/images/plane.png");
                    } else {
                        $(".tipe_delivery").text("Sea Freight")
                        $(".icon-new").attr("src", "{{url('frontend/assets')}}/images/ship.png");
                    }
                    $(".dtd").text(convertToRupiah(data.paket.door_to_door))
                    $(".dtp").text(convertToRupiah(data.paket.door_to_port))

                },
                error: function(data) {
                    console.log(data)
                }
            });
        });
    });

    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
    }
</script>
<script>
    var clicked = false
    $(document).ready(function() {
        $('.single-item').slick({
            slidesToShow: 1,
            dots: true
        });
        $(".nav-tabs a").click(function() {
            $("#status").hide()
            $(".widget-price").hide()
        })
        $(".btn-panel").click(function(event) {
            event.preventDefault();
            $(".panel-table").slideToggle("slow");
            if (clicked == false) {
                $(".text").text(" Sembunyikan Rincian")
                $("i.fa.fa-chevron-down").hide()
                $("i.fa.fa-chevron-up").show()
                clicked = true
            } else {
                $(".text").text(" Lihat Rincian")
                $("i.fa.fa-chevron-down").show()
                $("i.fa.fa-chevron-up").hide()
                clicked = false
            }
        });
    })
</script>
<script>
    var clicked = false
    $(document).ready(function() {
        $('.single-item').slick({
            slidesToShow: 1,
            dots: true
        });
        $(".nav-tabs a").click(function() {
            $("#status").hide()
            $(".widget-price").hide()
        })
        $(".btn-panel").click(function(event) {
            event.preventDefault();
            $(".panel-table").slideToggle("slow");
            if (clicked == false) {
                $(".text").text(" Sembunyikan Rincian")
                $("i.fa.fa-chevron-down").hide()
                $("i.fa.fa-chevron-up").show()
                clicked = true
            } else {
                $(".text").text(" Lihat Rincian")
                $("i.fa.fa-chevron-down").show()
                $("i.fa.fa-chevron-up").hide()
                clicked = false
            }
        });
    })

    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true
            });
        } else {
            obj[key] = value;
        }
        return obj;
    }
    $(function() {
        var _settings,
            _settings2,
            _settings3,
            _settings4;

        $('#artikel').slick({
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplaySpeed: 2500,
            speed: 2000,
            autoplay: false,
            prevArrow: '#prevArtikel',
            nextArrow: '#nextArtikel',
            responsive: [{
                breakpoint: 1024,
                settings: (_settings = {
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 1
                }, _defineProperty(_settings, 'infinite', true), _defineProperty(_settings, 'autoplay', false), _defineProperty(_settings, 'prevArrow', '#prevArtikel'), _defineProperty(_settings, 'nextArrow', '#nextArtikel'), _settings)
            }, {
                breakpoint: 600,
                settings: {
                    infinite: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: false,
                    prevArrow: '#prevArtikel',
                    nextArrow: '#nextArtikel'
                }
            }, {
                breakpoint: 480,
                settings: {
                    infinite: false,
                    slidesToShow: 1.25,
                    slidesToScroll: 1,
                    autoplay: false,
                    prevArrow: '#prevArtikel',
                    nextArrow: '#nextArtikel'
                }
            }]
        });

        // $('#artikel .item').matchHeight();
    });
</script>
<style>
    .slick-dots {
        padding-bottom: 20px;
    }

    .slick-dots li button:before,
    .slick-dots li.slick-active button:before {
        color: #FFF;
        opacity: 1;
        font-size: 13px;
        content: unset !important;
    }

    .slick-dots li {
        width: unset;
    }

    .slick-dots li button {
        background: #C9BDBD;
        border: 1px solid #C9BDBD;
        border-radius: 100%;
        width: 9px;
        height: 9px;
    }

    .slick-dots li.slick-active button {
        background: #976F6F;
        border: 1px solid #976F6F;
        border-radius: 100%;
        width: 9px;
        height: 9px;
    }

    .slick-dots li.slick-active button:before {
        color: transparent;
    }

    .easy {
        color: #D45700;
    }

    .section-top h1 {
        font-weight: bolder;
        margin-top: 10%;
    }

    .box-white {
        padding: 50px 20px;
    }

    .box-white h3 {
        line-height: 35px;
    }

    .box-white h1 {
        font-weight: bold;
    }

    .box-blog {
        padding: 50px 20px;
        background: #F4F0EB;
    }

    .box-blog h2 {
        font-weight: bold;
    }

    .single-item {
        padding: 50px 20px;
        max-width: 100%;
        overflow-x: hidden;
        background: #F4F0EB;
        padding-bottom: 0;
    }

    .single-item img {
        max-width: 400px;
        /* text-align: right; */
        margin-left: 30px;
        padding-left: 10px;
    }

    .slick-slide {
        height: 390px;
    }

    .slick-slide h1 {
        font-weight: bolder;
    }

    .slick-dots {
        bottom: 8px;
    }

    .section-satu {
        height: calc(130vh - 50px);
        background: url("{{url('frontend/assets')}}/images/home_satu.png") center no-repeat;
        background-size: cover;
        position: relative;
        margin-bottom: 0;
        border-bottom: none;
    }

    .section-top h1 {
        font-size: 58px;
    }

    .a-panduan {
        color: #BF202F;
        font-weight: 700;
    }

    .product-service {
        background-color: #D1500F;
        /*padding: 100px;*/
    }

    .product-service--title {
        margin-top: 5%;
        margin-bottom: 5%;
    }

    .product-service--title h1 {
        color: white;
        font-weight: 700;
    }

    .product-service img {
        margin-bottom: 20%;
    }

    .box-blog--lihat {
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .box-blog--lihat a {
        color: #BF202F;
        font-weight: 700;
    }

    .content-text-slider {
        background-color: #F5F5F5;
        padding: 1px 15px 15px;
        box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.2);
    }

    .content-text-slider h2 {
        font-size: 2rem;
        color: #444444;
    }

    .slide-wrapper {
        position: relative;
        height: fit-content;
    }

    .slick-disabled .fa.fa-angle-left {
        color: #F2F2F2;
    }

    i.fa.fa-angle-left {
        top: 131px;
        left: -47px;
        position: absolute;
        color: black;
        font-size: 96px;
    }

    i.fa.fa-angle-right {
        top: 131px;
        right: -47px;
        position: absolute;
        color: black;
        font-size: 96px;
    }

    .slider {
        width: 100%;
        overflow: hidden;
    }

    .slider .item {
        position: relative;
        overflow: hidden;
        box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.2);
    }

    .slider .item a.title {
        font-family: frank-new, sans-serif !important;
        font-size: 17px;
        font-weight: 500;
        font-style: normal;
        line-height: 1.4;
        color: #333333;
        letter-spacing: -0.5px;
    }

    .slider .slick-slide {
        margin: 0 12px;
    }

    .img-kategori {
        width: 270px;
        margin-top: unset;
    }

    .article--kategori .content-text {
        background-color: #F5F5F5;
        padding: 10px 10px 0;
        box-shadow: 2px 4px 6px 1px rgba(0, 0, 0, 0.2);
    }

    .article--kategori .content-text .content-title {
        margin-top: unset;
    }

    .article--video .content-image {
        margin-left: 1rem;
    }

    .section-kategori {
        margin-bottom: 5rem;
    }

    .slider .item a:not([class*="title"]) img {
        display: block;
        width: 100%;
    }

    .slider .item a:not([class*="title"]) {
        display: block;
    }

    .slick-list,
    .slick-slider {
        position: relative;
        display: block;
    }

    .topnav {
        overflow: hidden;
        background-color: #FFFFFF;
        display: table;
        margin: auto;
    }

    .topnav a {
        float: left;
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        border-bottom: 3px solid transparent;
    }

    .topnav a:hover {
        border-bottom: 3px solid #D45700;
    }

    .topnav a.active {
        border-bottom: 3px solid #D45700;
    }

    .icon-cek-harga {
        width: 10%;
    }

    /* 
              ##Device = Low Resolution Tablets, Mobiles (Landscape)
              ##Screen = B/w 481px to 767px
            */

    @media (min-width: 481px) and (max-width: 767px) {
        .img-logo {
            width: 50%;
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
    }

    /* 
              ##Device = Most of the Smartphones Mobiles (Portrait)
              ##Screen = B/w 320px to 479px
            */

    @media (min-width: 320px) and (max-width: 480px) {
        .img-logo {
            width: 50%;
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>

<section class="section-satu">
    <div class="container">
        <div class="section-top">
            <h1 class="text-center">Export Jadi <span class="easy">Mudah</span></h1>
            <ul class="nav nav-tabs">

                <li class="active tab-lacak">
                    <a data-toggle="tab" href="#home">
                        <h4>Lacak Kiriman</h4>
                    </a>
                </li>
                <li class="tab-cekharga">
                    <a data-toggle="tab" href="#menu1">
                        <h4>Cek Harga</h4>
                    </a>
                </li>

            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class=" box-top-new ">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input id="dimensi" type="text" class="form-control" name="noresi" placeholder="Nomor Resi">
                                            <span class="input-group-addon group-addon-resi">
                                                <button class="btn btn-cek">
                                                    <b>Lacak</b>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div class="topnav">
                        <a class="active" href="#General Cargo"><img src="{{url('frontend/assets')}}/images/box.png" class="icon-cek-harga"> General Cargo</a>
                        <a href="#Produk Pertanian"><img src="{{url('frontend/assets')}}/images/agriculture.png" class="icon-cek-harga"> Produk Pertanian</a>
                        <a href="#Hewan Hidup"><img src="{{url('frontend/assets')}}/images/animal.png" class="icon-cek-harga"> Hewan Hidup</a>
                        <a href="#Barang Berbahaya"><img src="{{url('frontend/assets')}}/images/fire.png" class="icon-cek-harga"> Barang Berbahaya</a>
                    </div>
                    <div class="box-top-new">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Dari</span>
                                    <input id="msg" type="text" class="form-control" value="Jakarta" name="msg" disabled placeholder="Dari">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Ke</span>
                                    <input type="hidden" id="id_daerah" name="id_daerah" class="input-top">
                                    <input type="hidden" id="daerah_text" name="daerah_text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Jenis</span>
                                    <input type="hidden" id="id_jenis_pengiriman" name="id_jenis_pengiriman" class="input-top">
                                    <input type="hidden" id="jenis_text" name="jenis_text">
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Via</span>
                                    <select id="tipe_pengiriman" class="selectpicker form-control" data-live-search="true" title="Please select a lunch ...">
                                        <option value="1">Udara</option>
                                        <option value="2">Laut</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Tipe</span>
                                    <select id="lunch" class="selectpicker form-control" data-live-search="true" title="Please select a lunch ...">
                                        <option>Paket</option>
                                        <option>Dokumen</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="panjang" type="text" class="form-control" name="panjang" placeholder="Panjang">
                                    <span class="input-group-addon addon-left"></span>
                                    <input id="lebar" type="text" class="form-control" name="lebar" placeholder="Lebar">
                                    <span class="input-group-addon addon-left"></span>
                                    <input id="tinggi" type="text" class="form-control" name="tinggi" placeholder="Tinggi">
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input id="dimensi" type="text" class="form-control" name="dimensi" placeholder="Berat">
                                    <span class="input-group-addon">Kg</span>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-4">
                                <div class="box-result-top" id="status" style="display: none;">
                                    <div class="col-md-6">
                                        <span>Total Volume: </br>
                                        </span>
                                        <span>
                                            <b id="volume">0.001 </b>
                                            <b> m<sup>3</sup>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span>Total Berat: </br>
                                        </span>
                                        <span>
                                            <b id="berat">10kg</b>
                                            <b> kg</b>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 text-right">
                                <button id="cekongkir" class="btn btn-cek">
                                    <h4>Dapatkan Harga Terbaik</h4>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-resi hidden-xs">
                    <div class="header-resi">
                        <h4>EXP12345678TD</h4>
                    </div>
                    <div class="body-resi">

                        <ul>

                            <li>
                                <hr />
                                <img src="{{url('frontend/assets')}}/images/document.png" />
                                <h4>Document Handling</h4>
                            </li>
                            <li>
                                <hr />
                                <img src="{{url('frontend/assets')}}/images/collected.png" />
                                <h4>Collected</h4>
                            </li>
                            <li>
                                <hr />
                                <img src="{{url('frontend/assets')}}/images/delivering.png" />
                                <h4>Delivering</h4>
                            </li>
                            <li>
                                <hr />
                                <img src="{{url('frontend/assets')}}/images/delivered.png" />
                                <h4>Delivered</h4>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-resi">
                        <h4>
                            <a class="btn-panel" href="#">
                                <i class="fa fa-chevron-down"></i>
                                <i class="fa fa-chevron-up" style="display: none;"></i>
                                <span class="text">Lihat Rincian</span></a>
                        </h4>
                    </div>
                    <div class="panel-table">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Local Time</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>08/03/2020, 20:15</td>
                                    <td>Jakarta, Indonesia</td>
                                    <td>Shipment delivered in good condition</td>
                                </tr>
                                <tr>
                                    <td>08/03/2020, 20:15</td>
                                    <td>Jakarta, Indonesia</td>
                                    <td>Shipment delivered in good condition</td>
                                </tr>
                                <tr>
                                    <td>08/03/2020, 20:15</td>
                                    <td>Jakarta, Indonesia</td>
                                    <td>Shipment delivered in good condition</td>
                                </tr>
                                <tr>
                                    <td>08/03/2020, 20:15</td>
                                    <td>Jakarta, Indonesia</td>
                                    <td>Shipment delivered in good condition</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="widget-price" style="display: none;">
    <table class="table table-harga">
        <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Moda</th>
                <th scope="col">Layanan</th>
                <th scope="col">Harga</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">
                    <img src="{{url('frontend/assets')}}/images/plane.png " class="icon-new"></th>
                <td class="tipe_delivery">Air Freight</td>
                <td>Door To Door &nbsp;<span data-tooltip="Door to Door adalah Lorem Ipsum" data-tooltip-location="bottom">
                        <i class="fa fa-info-circle"></i></span></td>
                <td>
                    <b class="complete">
                        <i class="fa fa-check-circle"></i>&nbsp; Layanan Lengkap</b>
                    <br />
                    <span class="dtd"> 1.500.000</span>
                </td>
                <td class="column-button">
                    <button class="btn btn-cek">
                        <h4>Kirim Sekarang</h4>
                    </button>
                </td>
            </tr>
            <tr>
                <th scope="row"><img src="{{url('frontend/assets')}}/images/plane.png " class="icon-new"></th>
                <td class="tipe_delivery">Air Freight</td>
                <td>Door To Port &nbsp;<span data-tooltip="Door to Port adalah Lorem Ipsum" data-tooltip-location="bottom">
                        <i class="fa fa-info-circle"></i></span></td>
                <td>
                    <span class="dtp">1.500.000</span>
                </td>
                <td class="column-button">
                    <button class="btn btn-cek">
                        <h4>Kirim Sekarang</h4>
                    </button>
                </td>
            </tr>

        </tbody>
    </table>
</div>

<div class="single-item ">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-right">
                    <h1>Panduan Ekspor</h1>
                    <h3>Ketahui barang apa saja yang bisa dikirim. Lihat kategori berikut. </h3>
                    <a class="a-panduan" href="#">Pelajari Lebih ></a>
                </div>
                <div class="col-md-6">
                    <img src="{{url('frontend/assets')}}/images/panduan_ekspor1.png" class="img-responsive" />
                </div>
            </div>
        </div>

    </div>
    <div>
        <div class="container">
            <div class="row">

                <div class="col-md-6 text-right">
                    <h1>Panduan Ekspor</h1>
                    <h3>Ketahui barang apa saja yang bisa dikirim. Lihat kategori berikut. </h3>
                    <a class="a-panduan" href="#">Pelajari Lebih ></a>
                </div>
                <div class="col-md-6">
                    <img src="{{url('frontend/assets')}}/images/panduan_ekspor1.png" class="img-responsive" />
                </div>

            </div>
        </div>

    </div>

</div>

<section class="product-service">
    <div class="container">
        <div class="row">
            <div class="product-service--title text-center">
                <h1>Product & Service</h1>
            </div>
            <div class="col-md-3">
                <img src="{{url('frontend/assets')}}/images/undername.png" class="img-responsive img-logo" />
            </div>
            <div class="col-md-3">
                <img src="{{url('frontend/assets')}}/images/airfreight.png" class="img-responsive img-logo" />
            </div>
            <div class="col-md-3">
                <img src="{{url('frontend/assets')}}/images/seafreight.png" class="img-responsive img-logo" />
            </div>
            <div class="col-md-3">
                <img src="{{url('frontend/assets')}}/images/tracking.png" class="img-responsive img-logo" />
            </div>
        </div>
    </div>
</section>

<div class="box-white ">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-md-7 ">
                <img src="{{url('frontend/assets')}}/images/ipad.png " class="img-responsive " />
            </div>
            <div class="col-md-4 ">
                <h1>ExportKu</h1>
                <h3>Kelola ekspor anda di sini. Rencanakan ekspor dan pantau pengiriman dengan mudah.</h3>
                <br />
                <br />
                <button class="btn btn-cek ">
                    <h4>Ketahui Lebih</h4>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="box-blog ">
    <div class="container ">
        <div class="row ">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Artikel Terbaru</h2>
                    </div>
                    <div class="col-md-6 box-blog--lihat text-right">
                        <a class="" href="#">Lihat Semua ></a>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <div class="single-item ">
            @foreach($blogs as $blog)
            <div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <a href="<?php echo TextHelp::generateLink($blog); ?>">
                                <h1 style="color:black">{{ $blog['title'] }}</h1>
                            </a>
                            <h3>{{ $blog['summary'] }}</h3>
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo TextHelp::generateLink($blog); ?>">
                                <img src="{{url('/images/'.$blog['imagesdetail']['path'])}}" class="img-responsive" />
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection