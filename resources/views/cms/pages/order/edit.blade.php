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
                        $("#id_negaras").select2({
                            placeholder: "Pilih Negara",
                        }).on("change", function(e) {
                            var id_negara = $('#id_negaras').val();
                            $('#id_negara').val(id_negara);
                        });
                        $("#id_negaras").val({{$kota->id_negara}}).trigger('change');
                    });
                </script>
                <div class="row my-3">
                    <div class="col-md-8 offset-md-2">
                        <form method="post" action="{{ route('kota.update', $kota->id) }}">
                            {{ method_field('PATCH') }}
                            <div class="card no-b">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Edit kota</h5>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-primary btn-sm " href="{{url('kota')}}">List kota</a>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="nama" class="col-form-label s-12">Nama</label>
                                                <input id="nama" placeholder="Enter kota nama" name="nama" value="{{ $kota->nama }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="id_negaras" class="col-form-label s-12">Negara</label>
                                                <select id="id_negaras">
                                                    @foreach($negara as $n)
                                                        <option></option>
                                                        <option value="{{ $n->id }}">{{ $n->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="id_negara" name="id_negara" value="{{ $kota->id_negara }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="kode_pos" class="col-form-label s-12">Kode Pos</label>
                                                <input id="kode_pos" placeholder="Enter kota kode_pos" name="kode_pos" value="{{ $kota->kode_pos }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="longitude" class="col-form-label s-12">Longitude</label>
                                                <input id="longitude" placeholder="Enter kota Longitude" name="longitude" value="{{ $kota->longitude }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="latitude" class="col-form-label s-12">Latitude</label>
                                                <input id="latitude" placeholder="Enter kota Latitude" name="latitude" value="{{ $kota->latitude }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="origin" class="col-form-label s-12">origin</label>
                                                <input id="origin" placeholder="Enter kota origin" name="origin" value="{{ $kota->origin }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTD_GC_50" class="col-form-label s-12">U_DTD_GC_50</label>
                                            <input id="U_DTD_GC_50" placeholder="Enter kota U_DTD_GC_50" name="U_DTD_GC_50" value="{{ $kota->U_DTD_GC_50 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTD_GC_100" class="col-form-label s-12">U_DTD_GC_100</label>
                                            <input id="U_DTD_GC_100" placeholder="Enter kota U_DTD_GC_100" name="U_DTD_GC_100" value="{{ $kota->U_DTD_GC_100 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTD_GC_350" class="col-form-label s-12">U_DTD_GC_350</label>
                                            <input id="U_DTD_GC_350" placeholder="Enter kota U_DTD_GC_350" name="U_DTD_GC_350" value="{{ $kota->U_DTD_GC_350 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTD_GC_500" class="col-form-label s-12">U_DTD_GC_500</label>
                                            <input id="U_DTD_GC_500" placeholder="Enter kota U_DTD_GC_500" name="U_DTD_GC_500" value="{{ $kota->U_DTD_GC_500 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTD_GC_1000" class="col-form-label s-12">U_DTD_GC_1000</label>
                                            <input id="U_DTD_GC_1000" placeholder="Enter kota U_DTD_GC_1000" name="U_DTD_GC_1000" value="{{ $kota->U_DTD_GC_1000 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTD_GC_LCL_2" class="col-form-label s-12">L_DTD_GC_LCL_2</label>
                                            <input id="L_DTD_GC_LCL_2" placeholder="Enter kota L_DTD_GC_LCL_2" name="L_DTD_GC_LCL_2" value="{{ $kota->L_DTD_GC_LCL_2 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTD_GC_LCL_6" class="col-form-label s-12">L_DTD_GC_LCL_6</label>
                                            <input id="L_DTD_GC_LCL_6" placeholder="Enter kota L_DTD_GC_LCL_6" name="L_DTD_GC_LCL_6" value="{{ $kota->L_DTD_GC_LCL_6 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTD_GC_LCL_10" class="col-form-label s-12">L_DTD_GC_LCL_10</label>
                                            <input id="L_DTD_GC_LCL_10" placeholder="Enter kota L_DTD_GC_LCL_10" name="L_DTD_GC_LCL_10" value="{{ $kota->L_DTD_GC_LCL_10 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTD_GC_FCL_20ft" class="col-form-label s-12">L_DTD_GC_FCL_20ft</label>
                                            <input id="L_DTD_GC_FCL_20ft" placeholder="Enter kota L_DTD_GC_FCL_20ft" name="L_DTD_GC_FCL_20ft" value="{{ $kota->L_DTD_GC_FCL_20ft }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTD_GC_FCL_40ft" class="col-form-label s-12">L_DTD_GC_FCL_40ft</label>
                                            <input id="L_DTD_GC_FCL_40ft" placeholder="Enter kota L_DTD_GC_FCL_40ft" name="L_DTD_GC_FCL_40ft" value="{{ $kota->L_DTD_GC_FCL_40ft }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTP_GC_50" class="col-form-label s-12">U_DTP_GC_50</label>
                                            <input id="U_DTP_GC_50" placeholder="Enter kota U_DTP_GC_50" name="U_DTP_GC_50" value="{{ $kota->U_DTP_GC_50 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTP_GC_100" class="col-form-label s-12">U_DTP_GC_100</label>
                                            <input id="U_DTP_GC_100" placeholder="Enter kota U_DTP_GC_100" name="U_DTP_GC_100" value="{{ $kota->U_DTP_GC_100 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTP_GC_350" class="col-form-label s-12">U_DTP_GC_350</label>
                                            <input id="U_DTP_GC_350" placeholder="Enter kota U_DTP_GC_350" name="U_DTP_GC_350" value="{{ $kota->U_DTP_GC_350 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTP_GC_500" class="col-form-label s-12">U_DTP_GC_500</label>
                                            <input id="U_DTP_GC_500" placeholder="Enter kota U_DTP_GC_500" name="U_DTP_GC_500" value="{{ $kota->U_DTP_GC_500 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="U_DTP_GC_1000" class="col-form-label s-12">U_DTP_GC_1000</label>
                                            <input id="U_DTP_GC_1000" placeholder="Enter kota U_DTP_GC_1000" name="U_DTP_GC_1000" value="{{ $kota->U_DTP_GC_1000 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_LCL_2" class="col-form-label s-12">L_DTP_GC_LCL_2</label>
                                            <input id="L_DTP_GC_LCL_2" placeholder="Enter kota L_DTP_GC_LCL_2" name="L_DTP_GC_LCL_2" value="{{ $kota->L_DTP_GC_LCL_2 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_LCL_3" class="col-form-label s-12">L_DTP_GC_LCL_3</label>
                                            <input id="L_DTP_GC_LCL_3" placeholder="Enter kota L_DTP_GC_LCL_3" name="L_DTP_GC_LCL_3" value="{{ $kota->L_DTP_GC_LCL_3 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_LCL_4" class="col-form-label s-12">L_DTP_GC_LCL_4</label>
                                            <input id="L_DTP_GC_LCL_4" placeholder="Enter kota L_DTP_GC_LCL_4" name="L_DTP_GC_LCL_4" value="{{ $kota->L_DTP_GC_LCL_4 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_LCL_5" class="col-form-label s-12">L_DTP_GC_LCL_5</label>
                                            <input id="L_DTP_GC_LCL_5" placeholder="Enter kota L_DTP_GC_LCL_5" name="L_DTP_GC_LCL_5" value="{{ $kota->L_DTP_GC_LCL_5 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_LCL_6" class="col-form-label s-12">L_DTP_GC_LCL_6</label>
                                            <input id="L_DTP_GC_LCL_6" placeholder="Enter kota L_DTP_GC_LCL_6" name="L_DTP_GC_LCL_6" value="{{ $kota->L_DTP_GC_LCL_6 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_LCL_7" class="col-form-label s-12">L_DTP_GC_LCL_7</label>
                                            <input id="L_DTP_GC_LCL_7" placeholder="Enter kota L_DTP_GC_LCL_7" name="L_DTP_GC_LCL_7" value="{{ $kota->L_DTP_GC_LCL_7 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_LCL_8" class="col-form-label s-12">L_DTP_GC_LCL_8</label>
                                            <input id="L_DTP_GC_LCL_8" placeholder="Enter kota L_DTP_GC_LCL_8" name="L_DTP_GC_LCL_8" value="{{ $kota->L_DTP_GC_LCL_8 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_LCL_9" class="col-form-label s-12">L_DTP_GC_LCL_9</label>
                                            <input id="L_DTP_GC_LCL_9" placeholder="Enter kota L_DTP_GC_LCL_9" name="L_DTP_GC_LCL_9" value="{{ $kota->L_DTP_GC_LCL_9 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_LCL_10" class="col-form-label s-12">L_DTP_GC_LCL_10</label>
                                            <input id="L_DTP_GC_LCL_10" placeholder="Enter kota L_DTP_GC_LCL_10" name="L_DTP_GC_LCL_10" value="{{ $kota->L_DTP_GC_LCL_10 }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_FCL_20ft" class="col-form-label s-12">L_DTP_GC_FCL_20ft</label>
                                            <input id="L_DTP_GC_FCL_20ft" placeholder="Enter kota L_DTP_GC_FCL_20ft" name="L_DTP_GC_FCL_20ft" value="{{ $kota->L_DTP_GC_FCL_20ft }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="L_DTP_GC_FCL_40ft" class="col-form-label s-12">L_DTP_GC_FCL_40ft</label>
                                            <input id="L_DTP_GC_FCL_40ft" placeholder="Enter kota L_DTP_GC_FCL_40ft" name="L_DTP_GC_FCL_40ft" value="{{ $kota->L_DTP_GC_FCL_40ft }}" class="form-control r-0 light s-12 " type="text">
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