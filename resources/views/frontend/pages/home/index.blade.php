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
                        $(".icon-new").attr("src", "images/plane.png");
                    } else {
                        $(".tipe_delivery").text("Sea Freight")
                        $(".icon-new").attr("src", "images/ship.png");
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
<style>
    .slick-dots {
        padding-bottom: 20px;
    }
    
    .slick-dots li.slick-active button:before,
    .slick-dots li button:before {
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
        color: #C2262D;
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
    
    .box-blog h2 a{
        font-weight: bold;
        text-decoration: none;
        color: #000;
    }
    
    .single-item {
        padding: 50px 20px;
        max-width: 100%;
        overflow-x: hidden;
        background: #F4F0EB;
        padding-bottom: 0px;
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
</style>
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
                                            <span class="input-group-addon group-addon-resi">  <button  class="btn btn-cek"><b>Lacak</b></button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div class="box-top-new">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Dari</span>
                                    <input id="msg" type="text" class="form-control" value="Jakarta" name="msg" disabled placeholder="Dari">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Ke</span>
                                    <input type="hidden" id="id_daerah" name="id_daerah" class="input-top">
                                    <input type="hidden" id="daerah_text" name="daerah_text">
                                </div>
                            </div>
                        </div>
                        <br/>
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
                                    <input id="panjang" type="text" class="form-control" name="panjang" placeholder="P">
                                    <span class="input-group-addon addon-left"></span>
                                    <input id="lebar" type="text" class="form-control" name="lebar" placeholder="L">
                                    <span class="input-group-addon addon-left"></span>
                                    <input id="tinggi" type="text" class="form-control" name="tinggi" placeholder="T">
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
                        <br/>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="box-result-top" id="status" style="display: none;">
                                    <div class="col-md-6">
                                        <span>Total Volume: </br></span>
                                        <span><b id="volume">0.001 </b><b> m<sup>3</sup></b> </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span>Total Berat: </br></span>
                                        <span><b id="berat">10kg</b><b> kg</b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 text-right">
                                <button id="cekongkir" class="btn btn-cek"><h4>Dapatkan Harga Terbaik</h4></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <div class="widget-resi">
            <div class="header-resi">
                <h4>EXP12345678TD</h4>
            </div>
            <div class="body-resi">

                <ul>

                    <li>
                        <hr/>
                        <img src="{{url('frontend/assets')}}/images/document.png" />
                        <h4>Document Handling</h4>
                    </li>
                    <li>
                        <hr/>
                        <img src="{{url('frontend/assets')}}/images/collected.png" />
                        <h4>Collected</h4>
                    </li>
                    <li>
                        <hr/>
                        <img src="{{url('frontend/assets')}}/images/delivering.png" />
                        <h4>Delivering</h4>
                    </li>
                    <li>
                        <hr/>
                        <img src="{{url('frontend/assets')}}/images/delivered.png" />
                        <h4>Delivered</h4>
                    </li>
                </ul>
            </div>
            <div class="footer-resi">
                <h4><a class="btn-panel" href="#"><i class="fa fa-chevron-down"></i> <i class="fa fa-chevron-up" style="display: none;"></i> <span class="text">Lihat Rincian</span></a></h4>
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
                        <th scope="row"> <img src="{{url('frontend/assets')}}/images/plane.png " class="icon-new"></th>
                        <td class="tipe_delivery">Air Freight</td>
                        <td>Door To Door &nbsp;<span data-tooltip="Door to Door adalah Lorem Ipsum" data-tooltip-location="bottom"><i class="fa fa-info-circle"></i></span></td>
                        <td>
                            <b class="complete"><i class="fa fa-check-circle"></i>&nbsp; Layanan Lengkap</b> <br/>
                            <span class="dtd"> 1.500.000</span>
                        </td>
                        <td class="column-button">
                            <button class="btn btn-cek"><h4>Kirim Sekarang</h4></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><img src="{{url('frontend/assets')}}/images/plane.png " class="icon-new"></th>
                        <td class="tipe_delivery">Air Freight</td>
                        <td>Door To Port &nbsp;<span data-tooltip="Door to Port adalah Lorem Ipsum" data-tooltip-location="bottom"><i class="fa fa-info-circle"></i></span></td>
                        <td>
                            <span class="dtp">1.500.000</span>
                        </td>
                        <td class="column-button">
                            <button class="btn btn-cek"><h4>Kirim Sekarang</h4></button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
    </div>
    <div class="box-red">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{url('frontend/assets')}}/images/imagewhite.png" class="img-responsive img-logo minus-margin " />
                    <h4 class="withpadding">Undername</h4>
                </div>
                <div class="col-md-3">
                    <img src="{{url('frontend/assets')}}/images/imagewhite.png" class="img-responsive img-logo" />
                    <h4 class="withpadding">Air Freight</h4>
                </div>
                <div class="col-md-3">
                    <img src="{{url('frontend/assets')}}/images/imagewhite.png" class="img-responsive img-logo  minus-margin " />
                    <h4 class="withpadding">Sea Freight</h4>
                </div>
                <div class="col-md-3">
                    <img src="{{url('frontend/assets')}}/images/imagewhite.png" class="img-responsive img-logo" />
                    <h4>Tracking Shipment</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="single-item ">
        <div>
            <div class="container">
                <div class="row">

                    <div class="col-md-6 text-right">
                        <h1>Panduan Ekspor 1</h1>
                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, sapien a consectetu</h3>
                    </div>
                    <div class="col-md-6">
                        <img src="{{url('frontend/assets')}}/images/redicon.png" class="img-responsive" />
                    </div>

                </div>
            </div>


        </div>
        <div>
            <div class="container">
                <div class="row">

                    <div class="col-md-6 text-right">
                        <h1>Panduan Ekspor 1</h1>
                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, sapien a consectetu</h3>
                    </div>
                    <div class="col-md-6">
                        <img src="{{url('frontend/assets')}}/images/redicon.png" class="img-responsive" />
                    </div>

                </div>
            </div>


        </div>

    </div>




    <div class="box-white ">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-md-7 ">
                    <img src="{{url('frontend/assets')}}/images/ipad.png " class="img-responsive " />
                </div>
                <div class="col-md-4 ">
                    <h1>ExportKu</h1>
                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit, sapien `a consectetu</h3>
                    <br/>
                    <br/>
                    <button class="btn btn-cek "><h4>Learn More</h4></button>
                </div>
            </div>
        </div>
    </div>
    <div class="box-blog ">
        <div class="container ">
            <div class="row ">
                <div class="col-md-12 ">
                    <h2 class="text-center ">
                        <a href="<?php echo url('/news')?>">Blog
                        </a>
                    </h2>
                </div>
                    @foreach($blogs as $blog)
                            <div class="col-md-4 ">
                                <img src="{{url('/images/'.$blog['imagesdetail']['path'])}} " class="img-responsive img-thumb" />
                                <h3> {{ $blog['title'] }}</h3>
                                <p> {{ $blog['summary'] }}</p>
                               
                            </div>
                    @endforeach
               
                
            </div>
        </div>
    </div>
@endsection