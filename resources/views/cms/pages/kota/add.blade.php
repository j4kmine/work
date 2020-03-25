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
                            placeholder: "Pilih Negara"
                        }).on("change", function(e) {
                            var id_negara = $('#id_negaras').val();
                            $('#id_negara').val(id_negara);
                            console.log(id_negara);
                        });
                    });
                </script>
            <div class="row my-3">
                <div class="col-md-8 offset-md-2">
                    <form enctype='multipart/form-data' method="post" action="{{ route('kota.store') }}">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Add kota</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('kota')}}">List kota</a>
                                    </div>
                                </div>
                               
                               
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="nama" class="col-form-label s-12">Nama</label>
                                            <input id="nama" placeholder="Enter kota nama" name="nama" value="{{ old('nama') }}" class="form-control r-0 light s-12 " type="text">
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
                                            <input type="hidden" id="id_negara" name="id_negara" value="{{ old('id_negara') }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="kode_pos" class="col-form-label s-12">Kode Pos</label>
                                            <input id="kode_pos" placeholder="Enter kota Kode Pos" name="kode_pos" value="{{ old('kode_pos') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="lang" class="col-form-label s-12">Longitude</label>
                                            <input id="lang" placeholder="Enter kota Longitude" name="lang" value="{{ old('lang') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="lat" class="col-form-label s-12">Latitude</label>
                                            <input id="lat" placeholder="Enter kota Latitude" name="lat" value="{{ old('lat') }}" class="form-control r-0 light s-12 " type="text">
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