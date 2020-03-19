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
                <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
                <script>
                    tinymce.init({
                        selector:'textarea',
                        width: 900,
                        height: 300
                    });
                </script>
            <div class="row my-3">
                <div class="col-md-8 offset-md-2">
                    <form enctype='multipart/form-data' method="post" action="{{ route('blog.store') }}">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Add Blog</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('blog')}}">List Blog</a>
                                    </div>
                                </div>
                               
                               
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Title</label>
                                            <input id="title" placeholder="Enter Blog Title" name="title" value="{{ old('title') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Summary</label>
                                            <input id="summary" placeholder="Enter Blog Summary" name="summary" value="{{ old('summary') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="address"  class="col-form-label s-12">Content</label>
                                            <textarea name="body" value="{{ old('body') }}" class="form-control r-0 light s-12" id="body" placeholder="Enter Blog Content"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Keyword</label>
                                            <input id="keyword" placeholder="Enter Blog keyword" name="keyword" value="{{ old('keyword') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary btn-lg openpopupberita"><i class="icon-image mr-2"></i>Pick Image</button>
                                <br/>
                                <div id="list-gambar-berita" class="row">
                                    @if(old('path') != '')
                                        <div class="card-body" id="{{ old('id_image') }}">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <img class="img-responsive" src="{{ old('path') }}">
                                                    <input name="id_image" type="hidden" value="{{ old('id_image') }}">
                                                    <input name="title_image" type="hidden" value="{{ old('title_image') }}">
                                                    <input name="path" type="hidden" value="{{ old('path') }}">
                                                    <h3 class="my-3">{{ old('title_image') }}</h3><button class="my-3 btn btn-danger btn-lg btn-block" onclick="removeimage({{ old('id_image') }})" type="button">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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