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
                url: 'http://18.141.205.174/api/listkotanegara',
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
                url: "http://18.141.205.174/api/cekongkir",
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
<style>
    .title-page {
        padding-top: 70px;
        padding-bottom: 35px;
        font-weight: bolder;
    }
</style>
    
<h1 class="text-center title-page">Cek Harga</h1>
<div class="container">
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
                    <span>Total Volume: </span>
                    <span><b id="volume">0.001 </b><b> m<sup>3</sup></b> </span>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    <span>Total Berat: </span>
                    <span><b id="berat">10kg</b><b> kg</b></span>
                </div>
            </div>
            <div class="col-md-8 text-right">
                <button id="cekongkir" class="btn btn-cek"><h4>Dapatkan Harga Terbaik</h4></button>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <div class="widget-price" style="display: none;">
        <table class="table">
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
                    <td>Door To Door &nbsp;<i class="fa fa-info-circle"></i></td>
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
                    <td>Door To Port &nbsp;<i class="fa fa-info-circle"></i></td>
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

<br/>
<br/>
@endsection