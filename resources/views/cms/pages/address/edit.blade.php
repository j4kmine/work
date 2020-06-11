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
                        $(".id_users").select2({
                          ajax: {
                            // url: "http://18.141.205.174/api/userselect2",
                            url: "http://127.0.0.1:8000/api/userselect2",
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
                              console.log(data);
                             return {
                                results: data[0].data
                                };
                            },
                            cache: false
                          },
                          placeholder: 'Pilih User',
                          minimumInputLength: 2
                        }).on("change", function(e) {
                            var id_users = $('.id_users').val();
                            $('#id_user').val(id_users);
                            $('#id_user_text').val($('.select2-chosen').text());
                        });

                        $(".id_kota").select2({
                          ajax: {
                            // url: "http://18.141.205.174/api/listkotanegara",
                            url: "http://127.0.0.1:8000/api/listkotanegara",
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
                          placeholder: 'Pilih Kota',
                          minimumInputLength: 2
                        }).on("change", function(e) {
                            var id_kota = $('.id_kota').val();
                            $('#id_kota').val(id_kota);
                            $('#id_kota_text').val($('.select2-chosen').text());
                            
                            var result_kota = $('.id_kota').select2('data');
                            $('#id_negara').val(result_kota[0]['id_negara']);
                            $('#id_negaras').val(result_kota[0]['id_negara']);
                            $('#kode_pos').val(result_kota[0]['kode_pos']);
                        });

                        // Create a DOM Option and pre-select by default
                        var newOption1 = new Option('{{$address->text_user}}', '{{$address->id_user}}', true, true);
                        var newOption2 = new Option('{{$address->text_kota}}', '{{$address->id_kota}}', true, true);
                        console.log(newOption1,newOption2);
                        // Append it to the select
                        $('.id_users').append(newOption1).trigger('change');
                        $('.id_kota').append(newOption2).trigger('change');

                        $('#id_user').val('{{$address->id_user}}');
                        $('#id_kota').val('{{$address->id_kota}}');
                        $('#id_negara').val('{{$address->id_negara}}');
                        $('#id_negaras').val('{{$address->id_negara}}');

                    });
                </script>
            <div class="row my-3">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{ route('address.update', $address->id) }}">
                        {{ method_field('PATCH') }}
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Add address</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('address')}}">List address</a>
                                    </div>
                                </div>
                               
                               
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="id_users" class="col-form-label s-12">User</label>
                                            <select class="id_users"></select>
                                            <input type="hidden" id="id_user" name="id_user" class="input-top">
                                            <input type="hidden" id="id_user_text" name="id_user_text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="company" class="col-form-label s-12">Company</label>
                                            <input id="company" placeholder="Enter company" name="company" value="{{ $address->company }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="no_hp" class="col-form-label s-12">Nomor Handphone</label>
                                            <input id="no_hp" placeholder="Enter no_hp" name="no_hp" value="{{ $address->no_hp }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="email" class="col-form-label s-12">email</label>
                                            <input id="email" placeholder="Enter email" name="email" value="{{ $address->email }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="tipe_user" class="col-form-label s-12">Tipe User</label>
                                            <div class="radio">
                                              <label><input type="radio" name="tipe_user" value="0" checked>Pengirim</label>
                                            </div>
                                            <div class="radio">
                                              <label><input type="radio" name="tipe_user" value="1">Penerima</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="catatan" class="col-form-label s-12">Catatan</label>
                                            <input id="catatan" placeholder="Enter catatan" name="catatan" value="{{ $address->catatan }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="id_kota" class="col-form-label s-12">Kota</label>
                                            <select class="id_kota"></select>
                                            <input type="hidden" id="id_kota" name="id_kota" class="input-top">
                                            <input type="hidden" id="id_kota_text" name="id_kota_text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="id_negaras" class="col-form-label s-12">Negara</label>
                                            <select class="form-control" id="id_negaras" disabled>
                                                <option value="">-Negara-</option>
                                                @foreach($negara as $n)
                                                    <option value="{{ $n->id }}">{{ $n->nama }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="id_negara" name="id_negara" value="{{ $address->id_negara }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="kode_pos" class="col-form-label s-12">Kode Pos</label>
                                            <input id="kode_pos" placeholder="Enter Kode Pos" name="kode_pos" value="{{ $address->kode_pos }}" class="form-control r-0 light s-12 " type="text" readonly="readonly">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="alamat" class="col-form-label s-12">Alamat</label>
                                            <input id="alamat" placeholder="Enter Alamat" name="alamat" value="{{ $address->alamat }}" class="form-control r-0 light s-12 " type="text">
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