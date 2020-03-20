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
                        @csrf
                        <input type="file" name="import_file" />
                        <button class="btn btn-primary">Import File</button>
                    </form>
                </div>
            </div>
            </div>
            
        
@endsection