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
                        <form method="post" action="{{ route('negara.update', $negara->id) }}">
                            {{ method_field('PATCH') }}
                            <div class="card no-b">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Edit negara</h5>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-primary btn-sm " href="{{url('negara')}}">List negara</a>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="nama" class="col-form-label s-12">Nama</label>
                                                <input id="nama" placeholder="Enter negara nama" name="nama" value="{{ $negara->nama }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="longitude" class="col-form-label s-12">Longitude</label>
                                                <input id="longitude" placeholder="Enter negara Longitude" name="longitude" value="{{ $negara->longitude }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="latitude" class="col-form-label s-12">Latitude</label>
                                                <input id="latitude" placeholder="Enter negara Latitude" name="latitude" value="{{ $negara->latitude }}" class="form-control r-0 light s-12 " type="text">
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