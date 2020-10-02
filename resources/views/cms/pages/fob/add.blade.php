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
                <div class="col-md-10 offset-md-1">
                    <form enctype='multipart/form-data' method="post" action="{{ route('fob.store') }}">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Add FOB</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('fob')}}">List FOB</a>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="tipe_fob" class="col-form-label s-12">Tipe FOB</label>
                                            <select class="form-control" id="tipe_fob" name="tipe_fob">
                                                <option value="">--Tipe--</option>
                                                <option value="1" @if (old('tipe_fob') == "1") {{ 'selected' }} @endif>FOB Udara </option>
                                                <option value="2" @if (old('tipe_fob') == "2") {{ 'selected' }} @endif>FOB LCL Laut</option>
                                                <option value="3" @if (old('tipe_fob') == "3") {{ 'selected' }} @endif>FOB FCL 20</option>
                                                <option value="3" @if (old('tipe_fob') == "4") {{ 'selected' }} @endif>FOB FCL 40</option>
                                                <option value="4" @if (old('tipe_fob') == "4") {{ 'selected' }} @endif>FOB Breakbulk</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
<div class="col-md-4">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="barang_umum" class="col-form-label s-12">FOB General Cargo</label>
                                            <input id="barang_umum" placeholder="Enter General Cargo" name="barang_umum" value="{{ old('barang_umum') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="agriculture" class="col-form-label s-12">FOB Agriculture</label>
                                            <input id="agriculture" placeholder="Enter Agriculture" name="agriculture" value="{{ old('agriculture') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="hewan_hidup" class="col-form-label s-12">FOB Hewan Hidup</label>
                                            <input id="hewan_hidup" placeholder="Enter Hewan Hidup" name="hewan_hidup" value="{{ old('hewan_hidup') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="barang_mudah_terbakar" class="col-form-label s-12">FOB Barang Mudah Terbakar</label>
                                            <input id="barang_mudah_terbakar" placeholder="Enter Barang Mudah Terbakar" name="barang_mudah_terbakar" value="{{ old('barang_mudah_terbakar') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
</div>
<div class="col-md-4">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="storage" class="col-form-label s-12">Storage General Cargo</label>
                                            <input id="storage" placeholder="Enter storage" name="storage" value="{{ old('storage') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="storage_agriculture" class="col-form-label s-12">Storage Agriculture</label>
                                            <input id="storage_agriculture" placeholder="Enter Storage Agriculture" name="storage_agriculture" value="{{ old('storage_agriculture') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="storage_hewan_hidup" class="col-form-label s-12">Storage Hewan Hidup</label>
                                            <input id="storage_hewan_hidup" placeholder="Enter Storage Hewan Hidup" name="storage_hewan_hidup" value="{{ old('storage_hewan_hidup') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="storage_barang_mudah_terbakar" class="col-form-label s-12">Storage Barang Mudah Terbakar</label>
                                            <input id="storage_barang_mudah_terbakar" placeholder="Enter Storage Barang Mudah Terbakar" name="storage_barang_mudah_terbakar" value="{{ old('storage_barang_mudah_terbakar') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
</div>
<div class="col-md-4">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="freaight" class="col-form-label s-12">Freight General Cargo</label>
                                            <input id="freaight" placeholder="Enter Freight" name="freaight" value="{{ old('freaight') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="freaight_agriculture" class="col-form-label s-12">Freight Agriculture</label>
                                            <input id="freaight_agriculture" placeholder="Enter Freight Agriculture" name="freaight_agriculture" value="{{ old('freaight_agriculture') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="freaight_hewan_hidup" class="col-form-label s-12">Freight Hewan Hidup</label>
                                            <input id="freaight_hewan_hidup" placeholder="Enter Freight Hewan Hidup" name="freaight_hewan_hidup" value="{{ old('freaight_hewan_hidup') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="freaight_barang_mudah_terbakar" class="col-form-label s-12">Freight Barang Mudah Terbakar</label>
                                            <input id="freaight_barang_mudah_terbakar" placeholder="Enter Freight Barang Mudah Terbakar" name="freaight_barang_mudah_terbakar" value="{{ old('freaight_barang_mudah_terbakar') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
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