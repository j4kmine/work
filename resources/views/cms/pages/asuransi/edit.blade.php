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
            $("#id_barang_jeniss").select2({
                placeholder: "Pilih Barang Jenis",
            }).on("change", function(e) {
                var id_barang_jenis = $('#id_barang_jeniss').val();
                $('#id_barang_jenis').val(id_barang_jenis);
            });
            $("#id_barang_jeniss").val({{$asuransi->id_jenis_barang}}).trigger('change');
        });
    </script>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-8 offset-md-2">
                <form method="post" action="{{ route('asuransi.update', $asuransi->id) }}">
                    {{ method_field('PATCH') }}
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Edit Asuransi</h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-primary btn-sm " href="{{url('asuransi')}}">List Asuransi</a>
                                </div>
                            </div>
                            <br/>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group m-0">
                                        <label for="title" class="col-form-label s-12">Title</label>
                                        <input id="title" placeholder="Enter title" name="title" value="{{ $asuransi->title }}" class="form-control r-0 light s-12 " type="text">
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group m-0">
                                        <label for="id_barang_jeniss" class="col-form-label s-12">Kategori</label>
                                        <select id="id_barang_jeniss">
                                            @foreach($barangjenis as $n)
                                                <option></option>
                                                <option value="{{ $n->id }}">{{ $n->title }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="id_barang_jenis" name="id_barang_jenis" value="{{ $asuransi->id_barang_jenis }}" />
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group">
                                <label for="is_aktif">Status</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_aktif" id="is_aktifYes" value="1" @if( $asuransi->is_aktif)) checked @endif>
                                        Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_aktif" id="is_aktifNo" value="0" @if(! $asuransi->is_aktif)) checked @endif>
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