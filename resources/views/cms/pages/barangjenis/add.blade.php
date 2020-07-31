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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#id_barang_kategoris").select2({
                placeholder: "Pilih Kategori"
            }).on("change", function(e) {
                var id_barang_kategori = $('#id_barang_kategoris').val();
                $('#id_barang_kategori').val(id_barang_kategori);
                console.log(id_barang_kategori);
            });
        });
    </script>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-8 offset-md-2">
                <form enctype='multipart/form-data' method="post" action="{{ route('barangjenis.store') }}">
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Add Barang Jenis</h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-primary btn-sm " href="{{url('barangjenis')}}">List Barang Jenis</a>
                                </div>
                            </div>
                            <br/>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group m-0">
                                        <label for="title" class="col-form-label s-12">Title</label>
                                        <input id="title" placeholder="Enter title" name="title" value="{{ old('title') }}" class="form-control r-0 light s-12 " type="text">
                                    </div>
                                </div>
                            </div>

                            <br/>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group m-0">
                                        <label for="id_barang_kategoris" class="col-form-label s-12">Kategori</label>
                                        <select id="id_barang_kategoris">
                                            @foreach($barangkategori as $n)
                                                <option></option>
                                                <option value="{{ $n->id }}">{{ $n->title }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="id_barang_kategori" name="id_barang_kategori" value="{{ old('id_barang_kategori') }}" />
                                    </div>
                                </div>
                            </div>

                            <br/>
                            <div class="form-group">
                                <label for="is_aktif">Status</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_aktif" id="is_aktifYes" value="1" @if(old('is_aktif')) checked @endif>
                                        Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_aktif" id="is_aktifNo" value="0" @if(!old('is_aktif')) checked @endif>
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