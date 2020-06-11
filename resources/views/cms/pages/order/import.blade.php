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
                    <form action="{{ route('kota.importData') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Import Kota</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('kota')}}">List kota</a>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="form-group m-0">
                                            <input type="file" name="import_file" />   
                                            <button class="btn btn-primary mt-2"><i class="icon-upload mr-2"></i> Import File</button>   
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div>
                        <p>Contoh Format pada file excel</p>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">nama</th>
                              <th scope="col">kode_pos</th>
                              <th scope="col">lang</th>
                              <th scope="col">lat</th>
                              <th scope="col">id_negara</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>Surabaya</th>
                              <td>12345</td>
                              <td>54321</td>
                              <td>09876</td>
                              <td>1</td>
                            </tr>
                            <tr>
                              <th>Bandung</th>
                              <td>12345</td>
                              <td>54321</td>
                              <td>09876</td>
                              <td>1</td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                    <div>
                      <p>List Id Negara</p>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">id negara</th>
                              <th scope="col">nama negara</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($negara as $value)
                              <tr>
                                <th>{{$value->id}}</th>
                                <th>{{$value->nama}}</th>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            
        
@endsection