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
                <script src="{{ asset('node_modules/tinymce/tinymce.min.js') }}"></script>
                <script>
                    tinymce.init({
                        selector:'textarea',
                        height: 400
                    });
                </script>
            <div class="row my-3">
                <div class="col-md-8 offset-md-2">
                    <form enctype='multipart/form-data' method="post" action="{{ route('negara.store') }}">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Add negara</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('negara')}}">List negara</a>
                                    </div>
                                </div>
                               
                               
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="nama" class="col-form-label s-12">Nama</label>
                                            <input id="nama" placeholder="Enter negara nama" name="nama" value="{{ old('nama') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="lang" class="col-form-label s-12">Longitude</label>
                                            <input id="lang" placeholder="Enter negara Longitude" name="lang" value="{{ old('lang') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="lat" class="col-form-label s-12">Latitude</label>
                                            <input id="lat" placeholder="Enter negara Latitude" name="lat" value="{{ old('lat') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="base_harga_udara_document" class="col-form-label s-12">base_harga_udara_document</label>
                                            <input id="base_harga_udara_document" placeholder="Enter negara base_harga_udara_document" name="base_harga_udara_document" value="{{ old('base_harga_udara_document') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="harga_fcl20ft" class="col-form-label s-12">harga_fcl20ft</label>
                                            <input id="harga_fcl20ft" placeholder="Enter negara harga_fcl20ft" name="harga_fcl20ft" value="{{ old('harga_fcl20ft') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="harga_fcl40ft" class="col-form-label s-12">harga_fcl40ft</label>
                                            <input id="harga_fcl40ft" placeholder="Enter negara harga_fcl40ft" name="harga_fcl40ft" value="{{ old('harga_fcl40ft') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="harga_fcl40fthq" class="col-form-label s-12">harga_fcl40fthq</label>
                                            <input id="harga_fcl40fthq" placeholder="Enter negara harga_fcl40fthq" name="harga_fcl40fthq" value="{{ old('harga_fcl40fthq') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="harga_bulk5kdwt" class="col-form-label s-12">harga_bulk5kdwt</label>
                                            <input id="harga_bulk5kdwt" placeholder="Enter negara harga_bulk5kdwt" name="harga_bulk5kdwt" value="{{ old('harga_bulk5kdwt') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="harga_bulk10kdwt" class="col-form-label s-12">harga_bulk10kdwt</label>
                                            <input id="harga_bulk10kdwt" placeholder="Enter negara harga_bulk10kdwt" name="harga_bulk10kdwt" value="{{ old('harga_bulk10kdwt') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="harga_bulk25kdwt" class="col-form-label s-12">harga_bulk25kdwt</label>
                                            <input id="harga_bulk25kdwt" placeholder="Enter negara harga_bulk25kdwt" name="harga_bulk25kdwt" value="{{ old('harga_bulk25kdwt') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="harga_bulk50kdwt" class="col-form-label s-12">harga_bulk50kdwt</label>
                                            <input id="harga_bulk50kdwt" placeholder="Enter negara harga_bulk50kdwt" name="harga_bulk50kdwt" value="{{ old('harga_bulk50kdwt') }}" class="form-control r-0 light s-12 " type="text">
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