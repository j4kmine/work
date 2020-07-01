@extends('../../../templatecms')


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
                <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
                <script>

                    $(document).ready(function() {
                        var count = {{ count($rel_item) }};
                        console.log(count);
                        dynamic_field(count);

                        function dynamic_field(number){
                            var html = '<tr>';
                            
                            html += '<td><input type="text" id="deskripsi" name="deskripsi[]" class="form-control"></td>';
                            html += '<td><input type="text" id="panjang" name="panjang[]" class="form-control"></td>';
                            html += '<td><input type="text" id="lebar" name="lebar[]" class="form-control"></td>';
                            html += '<td><input type="text" id="tinggi" name="tinggi[]" class="form-control"></td>';
                            html += '<td><input type="text" id="berat" name="berat[]" class="form-control"></td>';
                            html += '<td><input type="text" id="harga" name="harga[]" class="form-control harga"></td>';
                            if (number > 1) {
                                html += '<td><button type="button" name="remove" id="remove" class="btn btn-danger">Remove</button></td></tr>';
                                $('tbody').append(html);
                            } else {
                                html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                                $('tbody').html(html);
                            }
                        }

                        // $('#add').click(function(){
                        $(document).on('click', '#add', function(){
                            count++;
                            dynamic_field(count);
                        });

                        $(document).on('click', '#remove', function(){
                            count--;
                            $(this).closest("tr").remove();
                        });

                        $("table#barang-table").on("change", 'input[name^="panjang"], input[name^="lebar"], input[name^="tinggi"], input[name^="berat"]', function (event) {
                            var panjang = +$(this).closest("tr").find('input[name^="panjang"]').val();
                            var lebar = +$(this).closest("tr").find('input[name^="lebar"]').val();
                            var tinggi = +$(this).closest("tr").find('input[name^="tinggi"]').val();
                            var berat = +$(this).closest("tr").find('input[name^="berat"]').val();
                            var destination = $('#kota_tujuan').val();
                            var tipe_pengiriman = $('#tipe_pengiriman').val();
                            var jenis = $('#barang_kategori').val();
                            console.log(panjang,lebar,tinggi,berat,destination,tipe_pengiriman,jenis);
                            $.ajax({
                                type: "POST",
                                url: "http://18.141.205.174/api/cekongkir",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "panjang": panjang,
                                    "lebar": lebar,
                                    "tinggi": tinggi,
                                    "dimensi": berat,
                                    "destination": destination,
                                    "tipe_pengiriman": tipe_pengiriman,
                                    "jenis": jenis
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    // console.log(this);
                                    // $('#harga').val(data.paket.door_to_door);
                                    $("table#barang-table").on("change", 'input[name^="panjang"], input[name^="lebar"], input[name^="tinggi"], input[name^="berat"]', function (event) {
                                        console.log(data,this);
                                        $(this).closest("tr").find('input[name^="harga"]').val(data.paket.door_to_door);
                                        calculateSum();
                                    });
                                },
                                failure: function(errMsg) {
                                    console.log(errMsg);
                                }
                            });
                            
                        });

                        function cekHarga(panjang,lebar,tinggi,berat,destination,tipe_pengiriman,jenis) {
                            console.log(panjang,lebar,tinggi,berat,destination,tipe_pengiriman,jenis);
                            $.ajax({
                                type: "POST",
                                url: "http://18.141.205.174/api/cekongkir",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "panjang": panjang,
                                    "lebar": lebar,
                                    "tinggi": tinggi,
                                    "dimensi": berat,
                                    "destination": destination,
                                    "tipe_pengiriman": tipe_pengiriman,
                                    "jenis": jenis
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    console.log(data);
                                    return data;
                                },
                                failure: function(errMsg) {
                                    console.log(errMsg);
                                    return errMsg;
                                }
                            });
                        }
                        function calculateSum() {
                            var sum = 0;
                            $(".harga").each(function () {
                                if (!isNaN(this.value) && this.value.length != 0) {
                                    sum += parseFloat(this.value);
                                }
                            });
                            $("#total_harga").val(sum.toFixed(0));
                        }
                        $(document).on("change", ".harga", calculateSum);

                        $("#id_users").select2({
                            placeholder: "Pilih User",
                            disabled: true
                        }).on("change", function(e) {
                            var id_user = $('#id_users').val();
                            $('#id_user').val(id_user);
                        });

                        $("#pengirim_negaras").select2({
                            placeholder: "Pilih Negara"
                        }).on("change", function(e) {
                            var pengirim_negara = $('#pengirim_negaras').val();
                            $('#pengirim_negara').val(pengirim_negara);
                        });

                        $("#penerima_negaras").select2({
                            placeholder: "Pilih Negara"
                        }).on("change", function(e) {
                            var penerima_negara = $('#penerima_negaras').val();
                            $('#penerima_negara').val(penerima_negara);
                        });

                        $("#kota_tujuans").select2({
                          ajax: {
                            url: "http://18.141.205.174/api/listkotanegara",
                            dataType: 'json',
                            data: function (params) {
                              return {
                                q: params.term
                              };
                            },
                            processResults: function (data, params) {
                              // parse the results into the format expected by Select2
                              // since we are using custom formatting functions we do not need to
                              // alter the remote JSON data, except to indicate that infinite
                              // scrolling can be used
                             return {
                                results: data[0].data
                                };
                            },
                            cache: false
                          },
                          placeholder: 'Kota Tujuan',
                          minimumInputLength: 2
                        }).on("change", function(e) {
                            var kota_tujuan = $('#kota_tujuans').val();
                            $('#kota_tujuan').val(kota_tujuan);
                            $('#kota_tujuan_text').val($('.select2-chosen').text());
                        });

                        var $option = $('<option selected>Loading...</option>').val({{$order->kota_tujuan}});
                        $("#kota_tujuans").append($option).trigger('change');
                        var id_kota_tujuan = {{$order->kota_tujuan}};
                        $.ajax({ // make the request for the selected data object
                            type: "POST",
                            url: "http://18.141.205.174/api/getkota/",
                            // The key needs to match your method's input parameter (case-sensitive).
                            data: JSON.stringify({ 
                                "id": id_kota_tujuan
                                }),
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                        }).then(function (data) {
                          // Here we should have the data object
                          $option.text(data[0].text).val(data[0].id); // update the text that is displayed (and maybe even the value)
                          $option.removeData(); // remove any caching data that might be associated
                          $("#kota_tujuans").trigger('change'); // notify JavaScript components of possible changes
                        });

                        $('#tanggal_order').datetimepicker({
                            lang: 'id',
                            i18n:{
                                id:{
                                    months:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
                                    dayOfWeek:["Ming.", "Sen", "Sel", "Rab","Kam", "Jum", "Sab",]
                                }
                            },
                            timepicker: true,
                            mask: false,
                            closeOnDateSelect:false,
                            format:'d-m-Y H:i',
                            scrollInput:false,
                        });

                        $('#tanggal_kirim').datetimepicker({
                            lang: 'id',
                            i18n:{
                                id:{
                                    months:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
                                    dayOfWeek:["Ming.", "Sen", "Sel", "Rab","Kam", "Jum", "Sab",]
                                }
                            },
                            timepicker: true,
                            mask: false,
                            closeOnDateSelect:false,
                            scrollInput:false,
                            format:'d-m-Y H:i',
                            onShow:function( ct ){
                                this.setOptions({
                                    minDate:$('#tanggal_order').val()?$('#tanggal_order').val():'0',
                                    formatDate:'d-m-Y H:i'
                                })
                            },
                        });

                        $("#id_users").val({{$order->id_user}}).trigger('change');
                        $("#pengirim_negaras").val({{$order->pengirim_negara}}).trigger('change');
                        $("#penerima_negaras").val({{$order->penerima_negara}}).trigger('change');
                        $("#kota_tujuan").val("{{$order->kota_tujuan}}").trigger('change');
                        $("#tipe_pengiriman").val({{$order->tipe_pengiriman}});
                        $("#barang_kategori").val({{$order->barang_kategori}});
                        $("#status").val({{$order->status}});
                    });
                </script>
            <div class="row my-3">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{ route('order.update', $order->id) }}">
                        {{ method_field('PATCH') }}
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="id_users" class="col-form-label s-12">User</label>
                                            <select id="id_users">
                                                @foreach($user as $n)
                                                    <option></option>
                                                    <option value="{{ $n->id }}">{{ $n->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="id_user" name="id_user" value="{{ $order->id_user }}" />
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="kota_asal" class="col-form-label s-12">Kota asal</label>
                                            <input id="kota_asal" placeholder="Jakarta" name="kota_asal" class="form-control r-0 light s-12 " type="text" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="kota_tujuans" class="col-form-label s-12">Kota tujuan</label>
                                            <select id="kota_tujuans"><option></option></select>
                                            <input type="hidden" id="kota_tujuan" name="kota_tujuan" class="input-top" value="{{ $order->kota_tujuan }}">
                                            <input type="hidden" id="kota_tujuan_text" name="kota_asal_text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="tipe_pengiriman" class="col-form-label s-12">Tipe Pengiriman</label>
                                            <select class="form-control" id="tipe_pengiriman" name="tipe_pengiriman">
                                                <option value="1">Udara</option>
                                                <option value="2">Laut</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h1><b>DATA PEGIRIM</b></h1>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirim_nama" class="col-form-label s-12">Pengirim Nama</label>
                                            <input id="pengirim_nama" placeholder="Enter Pengirim Nama" name="pengirim_nama" value="{{ $order->pengirim_nama }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirim_negaras" class="col-form-label s-12">Pengirim Negara</label>
                                            <select id="pengirim_negaras">
                                                @foreach($negara as $n)
                                                    <option></option>
                                                    <option value="{{ $n->id }}">{{ $n->nama }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="pengirim_negara" name="pengirim_negara" value="{{ $order->pengirim_negara }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirim_kodepos" class="col-form-label s-12">Pengirim Kode Pos</label>
                                            <input id="pengirim_kodepos" placeholder="Enter Pengirim Kode Pos" name="pengirim_kodepos" value="{{ $order->pengirim_kodepos }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirim_kota" class="col-form-label s-12">Pengirim Kota</label>
                                            <input id="pengirim_kota" placeholder="Enter Pengirim Kota" name="pengirim_kota" value="{{ $order->pengirim_kota }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirim_alamat" class="col-form-label s-12">Pengirim Alamat</label>
                                            <input id="pengirim_alamat" placeholder="Enter Pengirim Alamat" name="pengirim_alamat" value="{{ $order->pengirim_alamat }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirim_perusahaan" class="col-form-label s-12">Pengirim Perusahaan</label>
                                            <input id="pengirim_perusahaan" placeholder="Enter Pengirim Perusahaan" name="pengirim_perusahaan" value="{{ $order->pengirim_perusahaan }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirim_telepon" class="col-form-label s-12">Pengirim Telepon</label>
                                            <input id="pengirim_telepon" placeholder="Enter Pengirim Telepon" name="pengirim_telepon" value="{{ $order->pengirim_telepon }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirim_email" class="col-form-label s-12">Pengirim Email</label>
                                            <input id="pengirim_email" placeholder="Enter Pengirim Email" name="pengirim_email" value="{{ $order->pengirim_email }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirim_koleksi_intruksi" class="col-form-label s-12">Pengirim Koleksi Intruksi</label>
                                            <input id="pengirim_koleksi_intruksi" placeholder="Enter Pengirim Koleksi Intruksi" name="pengirim_koleksi_intruksi" value="{{ $order->pengirim_koleksi_intruksi }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <h1><b>DATA PENERIMA</b></h1>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="penerima_nama" class="col-form-label s-12">penerima Nama</label>
                                            <input id="penerima_nama" placeholder="Enter penerima Nama" name="penerima_nama" value="{{ $order->penerima_nama }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="penerima_negaras" class="col-form-label s-12">penerima Negara</label>
                                            <select id="penerima_negaras">
                                                @foreach($negara as $n)
                                                    <option></option>
                                                    <option value="{{ $n->id }}">{{ $n->nama }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="penerima_negara" name="penerima_negara" value="{{ $order->penerima_negara }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="penerima_kodepos" class="col-form-label s-12">penerima Kode Pos</label>
                                            <input id="penerima_kodepos" placeholder="Enter penerima Kode Pos" name="penerima_kodepos" value="{{ $order->penerima_kodepos }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="penerima_kota" class="col-form-label s-12">penerima Kota</label>
                                            <input id="penerima_kota" placeholder="Enter penerima Kota" name="penerima_kota" value="{{ $order->penerima_kota }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="penerima_alamat" class="col-form-label s-12">penerima Alamat</label>
                                            <input id="penerima_alamat" placeholder="Enter penerima Alamat" name="penerima_alamat" value="{{ $order->penerima_alamat }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="penerima_perusahaan" class="col-form-label s-12">penerima Perusahaan</label>
                                            <input id="penerima_perusahaan" placeholder="Enter penerima Perusahaan" name="penerima_perusahaan" value="{{ $order->penerima_perusahaan }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="penerima_telepon" class="col-form-label s-12">penerima Telepon</label>
                                            <input id="penerima_telepon" placeholder="Enter penerima Telepon" name="penerima_telepon" value="{{ $order->penerima_telepon }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="penerima_email" class="col-form-label s-12">penerima Email</label>
                                            <input id="penerima_email" placeholder="Enter penerima Email" name="penerima_email" value="{{ $order->penerima_email }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="referensi_customer" class="col-form-label s-12">Referensi Customer</label>
                                            <input id="referensi_customer" placeholder="Enter Referensi Customer" name="referensi_customer" value="{{ $order->referensi_customer }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <h1><b>DATA BARANG</b></h1>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="barang_kategori" class="col-form-label s-12">Barang Kategori</label>
                                            <select class="form-control" id="barang_kategori" name="barang_kategori">
                                                <option value="1">DTD</option>
                                                <option value="2">DTP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- 
                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="barang_deskripsi" class="col-form-label s-12">Barang Deskripsi</label>
                                            <input id="barang_deskripsi" placeholder="Enter Barang Deskripsi" name="barang_deskripsi" value="{{ $order->barang_deskripsi }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="barang_nilai" class="col-form-label s-12">Barang Nilai</label>
                                            <input id="barang_nilai" placeholder="Enter Barang Nilai" name="barang_nilai" value="{{ $order->barang_nilai }}" class="form-control r-0 light s-12 " type="number"  min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="barang_jumlah" class="col-form-label s-12">Barang Jumlah</label>
                                            <input id="barang_jumlah" placeholder="Enter Barang Jumlah" name="barang_jumlah" value="{{ $order->barang_jumlah }}" class="form-control r-0 light s-12 " type="number"  min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="barang_dimensi" class="col-form-label s-12">Barang Dimensi</label>
                                            <input id="barang_dimensi" placeholder="Enter Barang Dimensi" name="barang_dimensi" value="{{ $order->barang_dimensi }}" class="form-control r-0 light s-12 " type="number"  min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="barang_berat" class="col-form-label s-12">Barang Berat</label>
                                            <input id="barang_berat" placeholder="Enter Barang Berat" name="barang_berat" value="{{ $order->barang_berat }}" class="form-control r-0 light s-12 " type="number"  min="0">
                                        </div>
                                    </div> -->

                                    <table class="table table-bordered table-striped mt-5" id="barang-table">
                                        <thead>
                                            <tr>
                                                <th>Deskripsi</th>
                                                <th>Panjang</th>
                                                <th>Lebar</th>
                                                <th>Tinggi</th>
                                                <th>Berat</th>
                                                <th>Harga</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rel_item as $key => $value)
                                                <tr>
                                                    <td><input type="text" id="deskripsi{{ $key }}" name="deskripsi[]" value="{{ $value->deskripsi }}" class="form-control"></td>
                                                    <td><input type="text" id="panjang{{ $key }}" name="panjang[]" value="{{ $value->panjang }}" class="form-control"></td>
                                                    <td><input type="text" id="lebar{{ $key }}" name="lebar[]" value="{{ $value->lebar }}" class="form-control"></td>
                                                    <td><input type="text" id="tinggi{{ $key }}" name="tinggi[]" value="{{ $value->tinggi }}" class="form-control"></td>
                                                    <td><input type="text" id="berat{{ $key }}" name="berat[]" value="{{ $value->berat }}" class="form-control"></td>
                                                    <td><input type="text" id="harga{{ $key }}" name="harga[]" value="{{ $value->harga }}" class="form-control harga"></td>
                                                    @if ($key == '0') 
                                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
                                                    @else 
                                                        <td><button type="button" name="remove" id="remove" class="btn btn-danger">Remove</button></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="layanan_tambahan" class="col-form-label s-12">Catatan</label>
                                            <input id="layanan_tambahan" placeholder="Enter Catatan" name="layanan_tambahan" value="{{ $order->layanan_tambahan }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="total_harga" class="col-form-label s-12">Total Harga</label>
                                            <input id="total_harga" placeholder="Enter Total Harga" name="total_harga" value="{{ $order->total_harga }}" class="form-control r-0 light s-12 " type="number" min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="total_approved" class="col-form-label s-12">Total Approved</label>
                                            <div class="radio">
                                              <label><input type="radio" name="total_approved" value="1">Ya</label>
                                            </div>
                                            <div class="radio">
                                              <label><input type="radio" name="total_approved" value="0" checked>Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="status" class="col-form-label s-12">Status</label>
                                            <select class="form-control" id="status" name="status">
                                              <option value="1">Status 1</option>
                                              <option value="2">Status 2</option>
                                              <option value="3">Status 3</option>
                                              <option value="4">Status 4</option>
                                              <option value="5">Status 5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="tanggal_order" class="col-form-label s-12">tanggal order</label>
                                            <input id="tanggal_order" placeholder="Enter tanggal order" name="tanggal_order" value="{{ date('d-m-Y H:i',strtotime($order->tanggal_order)) }}" class="form-control r-0 light s-12 " type="text" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="tanggal_kirim" class="col-form-label s-12">tanggal kirim</label>
                                            <input id="tanggal_kirim" placeholder="Enter tanggal kirim" name="tanggal_kirim" value="{{ date('d-m-Y H:i',strtotime($order->tanggal_kirim)) }}" class="form-control r-0 light s-12 " type="text" readonly>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            
        
@endsection