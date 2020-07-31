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
        <div class="row my-3">
            <div class="col-md-8 offset-md-2">
                <form method="post" action="{{ route('barangkategori.update', $barangkategori->id) }}">
                    {{ method_field('PATCH') }}
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Edit Barang Kategori</h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-primary btn-sm " href="{{url('barangkategori')}}">List Barang Kategori</a>
                                </div>
                            </div>
                            <br/>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group m-0">
                                        <label for="title" class="col-form-label s-12">Title</label>
                                        <input id="title" placeholder="Enter title" name="title" value="{{ $barangkategori->title }}" class="form-control r-0 light s-12 " type="text">
                                    </div>
                                </div>
                            </div>

                            <br/>    
                            <div class="form-group">
                                <label for="is_aktif">Status</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_aktif" id="is_aktifYes" value="1" @if( $barangkategori->is_aktif)) checked @endif>
                                        Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_aktif" id="is_aktifNo" value="0" @if(! $barangkategori->is_aktif)) checked @endif>
                                        No
                                    </label>
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