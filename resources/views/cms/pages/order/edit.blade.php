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
                    var origin   = window.location.origin; 
                    // console.log(origin);
                    $(document).ready(function() {
                        var count = {{ count($rel_item) }};
                        // console.log(count);
                        // dynamic_field(count);

                        function dynamic_field(number){
                            var html = '<tr>';
                            
                            html += '<td><input type="text" id="deskripsi'+number+'" name="deskripsi[]" class="form-control"></td>';
                            html += '<td><input type="text" id="qty_barang'+number+'" name="qty_barang[]" class="form-control"></td>';
                            html += '<td><select id="barang_package'+number+'" name="barang_package[]"><option value="">-Pilih-</option>@foreach($barangpackage as $i)<option value="{{ $i->id }}">{{ $i->title }}</option>@endforeach';
                            html += '</select><input type="text" id="barang_package_namaid'+number+'" name="barang_package_namaid[]" value="'+number+'" class="form-control" hidden><input type="text" id="barang_package_title'+number+'" name="barang_package_title[]" class="form-control" hidden></td>';
                            html += '<td><input type="text" id="panjang'+number+'" name="panjang[]" class="form-control"></td>';
                            html += '<td><input type="text" id="lebar'+number+'" name="lebar[]" class="form-control"></td>';
                            html += '<td><input type="text" id="tinggi'+number+'" name="tinggi[]" class="form-control"></td>';
                            html += '<td><input type="text" id="berat'+number+'" name="berat[]" class="form-control"></td>';
                            html += '<td><input type="text" id="harga'+number+'" name="harga[]" class="form-control harga"></td>';
                            html += '<input type="hidden" id="id_rel_item" name="id_rel_item[]" value="">';
                            if (number > 1) {
                                html += '<td><button type="button" name="remove" id="remove" class="btn btn-danger">Remove</button></td></tr>';
                                $('#tbody-barang').append(html);
                            } else {
                                html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                                $('#tbody-barang').html(html);
                            }
                        }

                        // $('#add').click(function(){
                        $(document).on('click', '#add', function(){
                            count++;
                            dynamic_field(count);
                        });

                        $(document).on('click', '#remove', function(){
                            count--;
                            var harga = +$(this).closest("tr").find('input[name^="harga"]').val();
                            penguranganHarga(harga);
                            $(this).closest("tr").remove();
                        });

                        $("table#barang-table").on("change", 'input[name^="qty_barang"], input[name^="panjang"], input[name^="lebar"], input[name^="tinggi"], input[name^="berat"]', function (event) {
                            var qty_barang = +$(this).closest("tr").find('input[name^="qty_barang"]').val();
                            var panjang = +$(this).closest("tr").find('input[name^="panjang"]').val();
                            var lebar = +$(this).closest("tr").find('input[name^="lebar"]').val();
                            var tinggi = +$(this).closest("tr").find('input[name^="tinggi"]').val();
                            var berat = +$(this).closest("tr").find('input[name^="berat"]').val();
                            var via_pengiriman = $('#via_pengiriman').val();
                            var jenis_pengiriman = $('#jenis_pengiriman').val();
                            var tipe_pengiriman = $('#tipe_pengiriman').val();
                            var destination = $('#kota_tujuan').val();
                            if (destination == "") {
                                alert("Mohon Pilih Kota Tujuan Dahulu.");
                            }
                            var qty_container = $('#qty_container').val();
                            var fob = '0';
                            if (jenis_pengiriman == '1' || jenis_pengiriman == '2') {
                                fob = '1';
                            } else if (jenis_pengiriman == '3') {
                                fob = '2';
                            } else if (jenis_pengiriman == '4') {
                                fob = '3';
                            } else if (jenis_pengiriman == '5') {
                                fob = '4';
                            } else if (jenis_pengiriman == '6') {
                                fob = '5';
                            }
                            console.log(panjang,lebar,tinggi,berat,via_pengiriman,jenis_pengiriman,tipe_pengiriman,destination,qty_container,fob);
                            $.ajax({
                                type: "POST",
                                url: origin+"/api/hargalisting",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "category_cargo" : jenis_pengiriman,
                                    "tipe_pengiriman": via_pengiriman,
                                    "tipe_delivery": tipe_pengiriman,
                                    "lebar": lebar,
                                    "tinggi": tinggi,
                                    "dimensi": berat,
                                    "panjang": panjang,
                                    "destination": destination,
                                    "qty_container" : qty_container,
                                    "tipe_package" : fob
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    // console.log(this);
                                    console.log(data);
                                    // $('#harga').val(data.paket.door_to_door);
                                    $("table#barang-table").on("change", 'input[name^="qty_barang"], input[name^="panjang"], input[name^="lebar"], input[name^="tinggi"], input[name^="berat"]', function (event) {
                                        // console.log(data,this);
                                        var qty_barang = +$(this).closest("tr").find('input[name^="qty_barang"]').val();
                                        var hargalisting = data.paket.door_to_port;
                                        var hargaakhir = qty_barang*hargalisting;
                                        $(this).closest("tr").find('input[name^="harga"]').val(hargaakhir);
                                        calculateSum();
                                        calculateSumAll();
                                    });
                                },
                                failure: function(errMsg) {
                                    // console.log(errMsg);
                                }
                            });
                            
                        });
                        /* table addons */
                        var count_addons = {{ count($rel_addons) }};
                        // dynamic_field_addons(count_addons);

                        function dynamic_field_addons(number){
                            var html = '<tr>';
                            
                            html += '<td><select id="id_item'+number+'" name="id_item[]"><option value="">-Pilih-</option>@foreach($item as $i)<option value="{{ $i->id }}">{{ $i->title }}</option>@endforeach';
                            html += '</select><input type="text" id="namaid" name="namaid[]" value="'+number+'" class="form-control" hidden><input type="text" id="title'+number+'" name="title[]" class="form-control" hidden></td>';
                            html += '<td><input type="text" id="jumlah'+number+'" name="jumlah[]" class="form-control"></td>';
                            html += '<td><input type="text" id="satuan'+number+'" name="satuan[]" class="form-control"></td>';
                            html += '<td><input type="text" id="harga_satuan'+number+'" name="harga_satuan[]" class="form-control"></td>';
                            html += '<td><input type="text" id="harga_total'+number+'" name="harga_total[]" class="form-control harga-addons"></td>';
                            html += '<input type="hidden" id="id_rel_addons" name="id_rel_addons[]" value="">';
                            if (number > 1) {
                                html += '<td><button type="button" name="remove_addons" id="remove_addons" class="btn btn-danger">Remove</button></td></tr>';
                                $('#tbody-addons').append(html);
                            } else {
                                html += '<td><button type="button" name="add_addons" id="add_addons" class="btn btn-success">Add</button></td></tr>';
                                $('#tbody-addons').html(html);
                            }
                        }
                        $(document).on('click', '#add_addons', function(){
                            count_addons++;
                            dynamic_field_addons(count_addons);
                        });

                        $(document).on('click', '#remove_addons', function(){
                            count_addons--;
                            var harga = +$(this).closest("tr").find('input[name^="harga_total"]').val();
                            penguranganHargaAddons(harga);
                            $(this).closest("tr").remove();
                        });

                        $("table#addons-table").on("change", 'select[name^="id_item"],input[name^="namaid"], input[name^="title"], input[name^="jumlah"], input[name^="satuan"], input[name^="harga_satuan"], input[name^="harga_total"]', function (event) {
                            var id_item = +$(this).closest("tr").find('select[name^="id_item"]').val();
                            var numbers = +$(this).closest("tr").find('input[name^="namaid"]').val();
                            $.ajax({
                                type: "POST",
                                url: origin+"/api/getitembyid",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "id": id_item
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    // console.log(this);
                                    // console.log(data.list.data[0]);
                                    $("#title"+numbers).val(data.list.data[0].title);
                                    $("#harga_satuan"+numbers).val(data.list.data[0].harga);
                                    $("table#addons-table").on("change", 'select[name^="id_item"],input[name^="namaid"], input[name^="title"], input[name^="jumlah"], input[name^="satuan"], input[name^="harga_satuan"], input[name^="harga_total"]', function (event) {
                                        // console.log(this);
                                        var jumlah = +$(this).closest("tr").find('input[name^="jumlah"]').val();
                                        var harga_satuan = +$(this).closest("tr").find('input[name^="harga_satuan"]').val();
                                        var total_harga = jumlah*harga_satuan;
                                        $(this).closest("tr").find('input[name^="harga_total"]').val(total_harga);
                                        calculateSumAddons();
                                        calculateSumAll();
                                    });
                                },
                                failure: function(errMsg) {
                                    // console.log(errMsg);
                                }
                            });     
                        });

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

                        function calculateSumAddons() {
                            var sum = 0;
                            $(".harga-addons").each(function () {
                                if (!isNaN(this.value) && this.value.length != 0) {
                                    sum += parseFloat(this.value);
                                }
                            });
                            $("#total_harga_addons").val(sum.toFixed(0));
                        }
                        $(document).on("change", ".harga-addons", calculateSumAddons);

                        function calculateSumAll() {
                            var sum = 0;
                            var total_harga = $("#total_harga").val();
                            if (total_harga == "") {
                                total_harga = 0;
                            }
                            var total_harga_addons = $("#total_harga_addons").val();
                            if (total_harga_addons == "") {
                                total_harga_addons = 0;
                            }
                            sum = parseFloat(total_harga) + parseFloat(total_harga_addons);
                            $("#total_harga_semua").val(sum.toFixed(0));
                        }
                        $(document).on("change", "#total_harga", calculateSumAll);
                        $(document).on("change", "#total_harga_addons", calculateSumAll);

                        function penguranganHarga(harga) {
                            var total_harga = $("#total_harga").val();
                            var total_harga_semua = $("#total_harga_semua").val();
                            var kurang_harga = total_harga-harga;
                            var kurang_harga_semua = total_harga_semua-harga;
                            $("#total_harga").val(kurang_harga.toFixed(0));
                            $("#total_harga_semua").val(kurang_harga_semua.toFixed(0));
                        }

                        function penguranganHargaAddons(harga) {
                            var total_harga_addons = $("#total_harga_addons").val();
                            var total_harga_semua = $("#total_harga_semua").val();
                            var kurang_harga = total_harga_addons-harga;
                            var kurang_harga_semua = total_harga_semua-harga;
                            $("#total_harga_addons").val(kurang_harga.toFixed(0));
                            $("#total_harga_semua").val(kurang_harga_semua.toFixed(0));
                        }

                        $("#id_users").select2({
                            placeholder: "Pilih User"
                        }).on("change", function(e) {
                            var id_user = $('#id_users').val();
                            $('#id_user').val(id_user);
                            pengirimAddress(id_user);
                            penerimaAddress(id_user);
                        });

                        $("#pengirims_choose_address").select2({
                            placeholder: "Pilih Pengirim Alamat"
                        }).on("change", function(e) {
                            var pengirims_choose_address = $('#pengirims_choose_address').val();
                            $('#pengirim_choose_address').val(pengirims_choose_address);
                            // console.log(pengirims_choose_address);
                            $.ajax({
                                type: "POST",
                                url: origin+"/api/getaddressbyid",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "id": pengirims_choose_address
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    var listdata = data.list.data;
                                    // console.log(listdata);
                                    $.each( listdata, function( key, value ) {
                                        $("#pengirim_negaras").val(value.id_negara).trigger('change');
                                        $('#pengirim_nama').val(value.nama);
                                        $('#pengirim_kodepos').val(value.kode_pos);
                                        $('#pengirim_kota').val(value.id_kota);
                                        $('#pengirim_alamat').val(value.alamat);
                                        $('#pengirim_perusahaan').val(value.company);
                                        $('#pengirim_telepon').val(value.no_hp);
                                        $('#pengirim_email').val(value.email);
                                        $('#pengirim_koleksi_intruksi').val(value.catatan);

                                        $.ajax({
                                            type: "POST",
                                            url: origin+"/api/getkotabyid",
                                            // The key needs to match your method's input parameter (case-sensitive).
                                            data: JSON.stringify({ 
                                                "id": value.id_kota
                                                }),
                                            contentType: "application/json; charset=utf-8",
                                            dataType: "json",
                                            success: function(data){
                                                // console.log(data.list.data);
                                                var listdata = data.list.data;

                                                $.each( listdata, function( key, value ) {
                                                    $('#pengirim_kota').val(value.nama);
                                                });
                                            },
                                            failure: function(errMsg) {
                                                // console.log(errMsg);
                                                return errMsg;
                                            }
                                        });
                                    });
                                    return data;
                                },
                                failure: function(errMsg) {
                                    // console.log(errMsg);
                                    return errMsg;
                                }
                            });
                        });

                        $("#penerimas_choose_address").select2({
                            placeholder: "Pilih Penerima Alamat"
                        }).on("change", function(e) {
                            var penerimas_choose_address = $('#penerimas_choose_address').val();
                            $('#penerima_choose_address').val(penerimas_choose_address);
                            $.ajax({
                                type: "POST",
                                url: origin+"/api/getaddressbyid",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "id": penerimas_choose_address
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    var listdata = data.list.data;
                                    // console.log(listdata);
                                    $.each( listdata, function( key, value ) {
                                        $("#penerima_negaras").val(value.id_negara).trigger('change');
                                        $('#penerima_nama').val(value.nama);
                                        $('#penerima_kodepos').val(value.kode_pos);
                                        $('#penerima_kota').val(value.id_kota);
                                        $('#penerima_alamat').val(value.alamat);
                                        $('#penerima_perusahaan').val(value.company);
                                        $('#penerima_telepon').val(value.no_hp);
                                        $('#penerima_email').val(value.email);
                                        $('#referensi_customer').val(value.catatan);

                                        $.ajax({
                                            type: "POST",
                                            url: origin+"/api/getkotabyid",
                                            // The key needs to match your method's input parameter (case-sensitive).
                                            data: JSON.stringify({ 
                                                "id": value.id_kota
                                                }),
                                            contentType: "application/json; charset=utf-8",
                                            dataType: "json",
                                            success: function(data){
                                                // console.log(data.list.data);
                                                var listdata = data.list.data;

                                                $.each( listdata, function( key, value ) {
                                                    $('#penerima_kota').val(value.nama);
                                                });
                                            },
                                            failure: function(errMsg) {
                                                // console.log(errMsg);
                                                return errMsg;
                                            }
                                        });

                                    });
                                    return data;
                                },
                                failure: function(errMsg) {
                                    // console.log(errMsg);
                                    return errMsg;
                                }
                            });
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
                            url: origin+"/api/listkotanegara",
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
                            url: origin+"/api/getkota/",
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

                        function pengirimAddress(id_user) {
                            // console.log(id_user);
                            $.ajax({
                                type: "POST",
                                url: origin+"/api/getaddressbyuser",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "id_user": id_user,
                                    "tipe_user": '0'
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    // console.log(data.list.data);
                                    var listdata = data.list.data;
                                    $.each( listdata, function( key, value ) {
                                      $('#pengirims_choose_address').append("<option value='"+value.id+"'>"+value.alamat+"</option>")
                                    });
                                    return data;
                                },
                                failure: function(errMsg) {
                                    // console.log(errMsg);
                                    return errMsg;
                                }
                            });
                        }

                        function penerimaAddress(id_user) {
                            // console.log(id_user);
                            $.ajax({
                                type: "POST",
                                url: origin+"/api/getaddressbyuser",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "id_user": id_user,
                                    "tipe_user": '1'
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    // console.log(data.list.data);
                                    var listdata = data.list.data;
                                    $.each( listdata, function( key, value ) {
                                      $('#penerimas_choose_address').append("<option value='"+value.id+"'>"+value.alamat+"</option>")
                                    });
                                    return data;
                                },
                                failure: function(errMsg) {
                                    // console.log(errMsg);
                                    return errMsg;
                                }
                            });
                        }

                        $("#id_users").val({{$order->id_user}}).trigger('change');
                        $("#pengirim_negaras").val({{$order->pengirim_negara}}).trigger('change');
                        $("#penerima_negaras").val({{$order->penerima_negara}}).trigger('change');
                        $("#kota_tujuan").val("{{$order->kota_tujuan}}").trigger('change');
                        $("#tipe_pengiriman").val({{$order->tipe_pengiriman}});
                        $("#barang_kategori").val({{$order->barang_kategori}});
                        $("#status").val({{$order->status}});

                        $("#via_pengiriman").change(function(){
                            if (this.value == 1) {
                                var newOptions = {
                                    @foreach($jenis_pengiriman as $key => $v)
                                        @if($v['via_pengiriman'] == '1')
                                            "{{ $v['nama'] }}": "{{ $key }}",
                                        @endif
                                    @endforeach
                                };

                                $('#group_qty_container').hide();
                            } else {
                                var newOptions = {
                                    @foreach($jenis_pengiriman as $key => $v)
                                        @if($v['via_pengiriman'] == '2')
                                            "{{ $v['nama'] }}": "{{ $key }}",
                                        @endif
                                    @endforeach
                                };

                                $('#group_qty_container').show();
                            }
                            var $el = $("#jenis_pengiriman");
                            $el.empty(); // remove old options
                            $.each(newOptions, function(key,value) {
                              $el.append($("<option></option>")
                                 .attr("value", value).text(key));
                            });
                        });

                        // load first page
                        var barang_kategori_val = $("#barang_kategori").val();
                        $.ajax({
                            type: "POST",
                            url: origin+"/api/getbarangjenisbybarangkategori",
                            // The key needs to match your method's input parameter (case-sensitive).
                            data: JSON.stringify({ 
                                "id_barang_kategori": barang_kategori_val
                                }),
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            success: function(data){
                                // console.log(data.list.data);
                                var listdata = data.list.data;

                                var newOptions = {};
                                $.each( listdata, function( key, value ) {
                                    newOptions[value.title] = value.id;
                                });

                                var $el = $("#barang_jenis");
                                $el.empty(); // remove old options
                                $.each(newOptions, function(key,value) {
                                  $el.append($("<option></option>")
                                     .attr("value", value).text(key));
                                });

                                // get asuransi
                                var barang_jenis_val = $("#barang_jenis").val();
                                // console.log(barang_jenis_val);
                                $.ajax({
                                    type: "POST",
                                    url: origin+"/api/getasuransibybarangjenis",
                                    // The key needs to match your method's input parameter (case-sensitive).
                                    data: JSON.stringify({ 
                                        "id_barang_jenis": barang_jenis_val
                                        }),
                                    contentType: "application/json; charset=utf-8",
                                    dataType: "json",
                                    success: function(data){
                                        // console.log(data.list.data);
                                        var listdata = data.list.data;

                                        var newOptions = {};
                                        $.each( listdata, function( key, value ) {
                                            newOptions[value.title] = key;
                                        });

                                        var $el = $("#asuransi");
                                        $el.empty(); // remove old options
                                        $.each(newOptions, function(key,value) {
                                          $el.append($("<option></option>")
                                             .attr("value", value).text(key));
                                        });
                                    },
                                    failure: function(errMsg) {
                                        // console.log(errMsg);
                                        return errMsg;
                                    }
                                });
                            },
                            failure: function(errMsg) {
                                // console.log(errMsg);
                                return errMsg;
                            }
                        });

                        $("#barang_kategori").change(function(){
                            // console.log(this.value);
                            $.ajax({
                                type: "POST",
                                url: origin+"/api/getbarangjenisbybarangkategori",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "id_barang_kategori": this.value
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    // console.log(data.list.data);
                                    var listdata = data.list.data;

                                    var newOptions = {};
                                    $.each( listdata, function( key, value ) {
                                        newOptions[value.title] = value.id;
                                    });

                                    var $el = $("#barang_jenis");
                                    $el.empty(); // remove old options
                                    $.each(newOptions, function(key,value) {
                                      $el.append($("<option></option>")
                                         .attr("value", value).text(key));
                                    });

                                    // get asuransi
                                    var id_barang_jenis = $("#barang_jenis").val();
                                    $.ajax({
                                        type: "POST",
                                        url: origin+"/api/getasuransibybarangjenis",
                                        // The key needs to match your method's input parameter (case-sensitive).
                                        data: JSON.stringify({ 
                                            "id_barang_jenis": id_barang_jenis
                                            }),
                                        contentType: "application/json; charset=utf-8",
                                        dataType: "json",
                                        success: function(data){
                                            // console.log(data.list.data);
                                            var listdata = data.list.data;

                                            var newOptions = {};
                                            $.each( listdata, function( key, value ) {
                                                newOptions[value.title] = value.id;
                                            });

                                            var $el = $("#asuransi");
                                            $el.empty(); // remove old options
                                            $.each(newOptions, function(key,value) {
                                              $el.append($("<option></option>")
                                                 .attr("value", value).text(key));
                                            });
                                        },
                                        failure: function(errMsg) {
                                            // console.log(errMsg);
                                            return errMsg;
                                        }
                                    });
                                },
                                failure: function(errMsg) {
                                    // console.log(errMsg);
                                    return errMsg;
                                }
                            });
                        });

                        $("#barang_jenis").change(function(){
                            // console.log(this.value);
                            $.ajax({
                                type: "POST",
                                url: origin+"/api/getasuransibybarangjenis",
                                // The key needs to match your method's input parameter (case-sensitive).
                                data: JSON.stringify({ 
                                    "id_barang_jenis": this.value
                                    }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                success: function(data){
                                    // console.log(data.list.data);
                                    var listdata = data.list.data;

                                    var newOptions = {};
                                    $.each( listdata, function( key, value ) {
                                        newOptions[value.title] = value.id;
                                    });

                                    var $el = $("#asuransi");
                                    $el.empty(); // remove old options
                                    $.each(newOptions, function(key,value) {
                                      $el.append($("<option></option>")
                                         .attr("value", value).text(key));
                                    });
                                },
                                failure: function(errMsg) {
                                    // console.log(errMsg);
                                    return errMsg;
                                }
                            });
                        });

                        calculateSum();
                        calculateSumAddons();
                        calculateSumAll();
                        calculateSumAll();
                    });
                </script>
            <div class="row my-3">
                <div class="col-md-10 offset-md-1">
                    <form method="post" action="{{ route('order.update', $order->id) }}">
                        {{ method_field('PATCH') }}
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Edit Order</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('order')}}">List Order</a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4">
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

                                    <div class="col-md-4">
                                        <div class="form-group m-0">
                                            <label for="kota_asal" class="col-form-label s-12">Kota asal</label>
                                            <input id="kota_asal" placeholder="Jakarta" name="kota_asal" class="form-control r-0 light s-12 " type="text" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group m-0">
                                            <label for="kota_tujuans" class="col-form-label s-12">Kota tujuan</label>
                                            <select id="kota_tujuans"><option></option></select>
                                            <input type="hidden" id="kota_tujuan" name="kota_tujuan" class="input-top" value="{{ $order->kota_tujuan }}">
                                            <input type="hidden" id="kota_tujuan_text" name="kota_asal_text">
                                        </div>
                                    </div>
                                </div>

                                <h1><b>DATA PENGIRIM</b></h1>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="pengirims_choose_address" class="col-form-label s-12">Pilih Alamat(Optional - Ambil Dari Modul Address Berdasarkan User)</label>
                                            <select id="pengirims_choose_address">
                                                    <option></option>
                                            </select>
                                            <input type="hidden" id="pengirim_choose_address" name="pengirim_choose_address" value="" />
                                        </div>
                                    </div>
                                </div>

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
                                            <label for="penerimas_choose_address" class="col-form-label s-12">Pilih Alamat(Optional - Ambil Dari Modul Address Berdasarkan User)</label>
                                            <select id="penerimas_choose_address">
                                                    <option></option>
                                            </select>
                                            <input type="hidden" id="penerima_choose_address" name="penerima_choose_address" value="" />
                                        </div>
                                    </div>
                                </div>

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

                                <h1><b>DATA PENGIRIMAN</b></h1>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="via_pengiriman" class="col-form-label s-12">Via Pengiriman</label>
                                            <select class="form-control" id="via_pengiriman" name="via_pengiriman">
                                                @foreach($via_pengiriman as $key => $v)
                                                    <option value="{{ $key }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="jenis_pengiriman" class="col-form-label s-12">Jenis Pengiriman</label>
                                            <select class="form-control" id="jenis_pengiriman" name="jenis_pengiriman">
                                                @foreach($jenis_pengiriman as $key => $v)
                                                    @if($v['via_pengiriman'] == '1')
                                                        <option value="{{ $key }}">{{ $v['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="tipe_pengiriman" class="col-form-label s-12">Tipe Pengiriman</label>
                                            <select class="form-control" id="tipe_pengiriman" name="tipe_pengiriman">
                                                @foreach($tipe_pengiriman as $key => $v)
                                                    <option value="{{ $key }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="group_qty_container" style="display: none;">
                                        <div class="form-group m-0">
                                            <label for="qty_container" class="col-form-label s-12">Qty Container</label>
                                            <input id="qty_container" placeholder="Enter Qty Container" name="qty_container" value="1" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                
                                </div>

                                <h1><b>DATA BARANG</b></h1>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="barang_kategori" class="col-form-label s-12">Barang Kategori</label>
                                            <select class="form-control" id="barang_kategori" name="barang_kategori">
                                                @foreach($barangkategori as $key => $v)
                                                    @if($v->is_aktif == '1')
                                                        <option value="{{ $v->id }}">{{ $v->title }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="barang_jenis" class="col-form-label s-12">Barang Jenis</label>
                                            <select class="form-control" id="barang_jenis" name="barang_jenis">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-0">
                                            <label for="asuransi" class="col-form-label s-12">Asuransi</label>
                                            <select class="form-control" id="asuransi" name="asuransi">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <table class="table table-bordered table-striped mt-5" id="barang-table">
                                        <thead>
                                            <tr>
                                                <th>Deskripsi</th>
                                                <th>Qty</th>
                                                <th>Package</th>
                                                <th>Panjang</th>
                                                <th>Lebar</th>
                                                <th>Tinggi</th>
                                                <th>Berat</th>
                                                <th>Harga</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-barang">
                                            @foreach ($rel_item as $key => $value)
                                                <tr>
                                                    <td><input type="text" id="deskripsi{{ $key }}" name="deskripsi[]" value="{{ $value->deskripsi }}" class="form-control"></td>
                                                    <td><input type="text" id="qty_barang{{ $key }}" name="qty_barang[]" value="{{ $value->qty_barang }}" class="form-control"></td>
                                                    <td>
                                                        <select id="barang_package{{ $key }}" name="barang_package[]">
                                                            <option value="">-Pilih-</option>
                                                            @foreach($barangpackage as $i)
                                                                @php
                                                                    $selecteds = '';
                                                                    $id1 = $value->id_package_barang;
                                                                    $id2 = $i->id;
                                                                    if ($id1  ==  $id2){$selecteds = 'selected';}
                                                                @endphp
                                                                <option {{ $selecteds }}  value="{{ $i->id }}">{{ $i->title }}</option>
                                                            @endforeach
                                                        </select>
                                                            <input type="text" id="barang_package_namaid{{ $key }}" name="barang_package_namaid[]" value="{{ $key }}" class="form-control" hidden>
                                                            <input type="text" id="barang_package_title{{ $key }}" name="barang_package_title[]" class="form-control" hidden>
                                                        </td>
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
                                                    <input type="hidden" name="id_rel_item[]" value="{{ $value->id }}">
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
                                            <label for="total_harga" class="col-form-label s-12">Total Harga Kirim</label>
                                            <input id="total_harga" placeholder="Enter Total Harga" name="total_harga" value="{{ old('total_harga') }}" class="form-control r-0 light s-12 " type="number" min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="addons-table" class="col-form-label s-12">Daftar Addons</label>
                                            <table class="table table-bordered table-striped mt-1" id="addons-table">
                                                <thead>
                                                    <tr>
                                                        <th>Layanan Tambahan</th>
                                                        <th>Qty</th>
                                                        <th>Satuan</th>
                                                        <th>Harga Satuan</th>
                                                        <th>Harga Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody-addons">
                                                    @foreach ($rel_addons as $key => $value)
                                                        <tr>
                                                            <td>
                                                                <select id="id_item{{ $key }}" name="id_item[]">
                                                                    <option value="">-Pilih-</option>
                                                                    @foreach($item as $i)
                                                                        @php
                                                                            $selected = '';
                                                                            $id1 = $value->id_item;
                                                                            $id2 = $i->id;
                                                                            if ($id1  ==  $id2){$selected = 'selected';}
                                                                        @endphp
                                                                        <option {{ $selected }}  value="{{ $i->id }}">{{ $i->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="text" id="namaid{{ $key }}" name="namaid[]" value="" class="form-control" hidden>
                                                                <input type="text" id="title{{ $key }}" name="title[]" value="" class="form-control" hidden>
                                                            </td>
                                                            <td><input type="text" id="jumlah{{ $key }}" name="jumlah[]" value="{{ $value->jumlah }}" class="form-control"></td>
                                                            <td><input type="text" id="satuan{{ $key }}" name="satuan[]" value="{{ $value->satuan }}" class="form-control"></td>
                                                            <td><input type="text" id="harga_satuan{{ $key }}" name="harga_satuan[]" value="{{ $value->harga_satuan }}" class="form-control"></td>
                                                            <td><input type="text" id="harga_total{{ $key }}" name="harga_total[]" value="{{ $value->harga_total }}" class="form-control harga-addons"></td>
                                                            @if ($key == '0') 
                                                                <td><button type="button" name="add_addons" id="add_addons" class="btn btn-success">Add</button></td>
                                                            @else 
                                                                <td><button type="button" name="remove_addons" id="remove_addons" class="btn btn-danger">Remove</button></td>
                                                            @endif
                                                            <input type="hidden" name="id_rel_addons[]" value="{{ $value->id }}">
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="total_harga_addons" class="col-form-label s-12">Total Harga Addons</label>
                                            <input id="total_harga_addons" placeholder="Enter Total Harga" name="total_harga_addons" value="{{ old('total_harga_addons') }}" class="form-control r-0 light s-12 " type="number" min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="total_harga_semua" class="col-form-label s-12">Total Harga Semua</label>
                                            <input id="total_harga_semua" placeholder="Enter Total Harga" name="total_harga_semua" value="{{ $order->total_harga }}" class="form-control r-0 light s-12 " type="number" min="0">
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="total_approved" class="col-form-label s-12">Total Approved</label>
                                            <div class="radio">
                                              <label><input type="radio" name="total_approved" value="1" @if ($order->total_approved == "1") {{ 'checked' }} @endif>Ya</label>
                                            </div>
                                            <div class="radio">
                                              <label><input type="radio" name="total_approved" value="0" @if ($order->total_approved == "0") {{ 'checked' }} @endif>Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="status" class="col-form-label s-12">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                @foreach($status_order as $key => $v)
                                                    <option value="{{ $key }}">{{ $v }}</option>
                                                @endforeach
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